<?php
// session_start();
// if(isset($_SESSION['username']) && isset($_SESSION['password'])){
//
//     $usernname = $_SESSION['username'];
//     $password = $_SESSION['password'];
//
//     echo $_SEESION();
//
//     //$role = $_SESSION['role'];
// }else
// {
//   header('location:login.php');
// }

include ('database/DB.php');
include ('database/post.php');
include ('login/Login.php');
include ('database/Image.php');
include ('database/notify.php');

$username = "";
$user_id = "";
$follower_id = "";
$verified = False;
$isFollowing = False;





if (isset($_GET['username'])) {
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {

                $username = DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];

                $user_id = DB::query('SELECT user_id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['user_id'];


                $follower_id = Login::isLoggedIn();


                if (isset($_POST['follow'])) {
                        if ($user_id != $follower_id) {
                                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:user_id AND follower_id=:follower_id', array(':user_id'=>$user_id, ':follower_id'=>$follower_id))) {
                                        DB::query('INSERT INTO followers VALUES (\'\', :userid, :follower_id)', array(':userid'=>$user_id, ':follower_id'=>$follower_id));
                                } else {
                                        echo 'Already following!';
                                }
                                $isFollowing = True;
                        }
                }
                if (isset($_POST['unfollow'])) {
                        if ($user_id != $follower_id) {
                                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:follower_id', array(':userid'=>$user_id, ':follower_id'=>$follower_id))) {
                                        DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:follower_id', array(':userid'=>$user_id, ':follower_id'=>$follower_id));
                                }
                                $isFollowing = False;
                        }
                }
                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:follower_id', array(':userid'=>$user_id, ':follower_id'=>$follower_id))){
                        //echo 'Already following!';
                        $isFollowing = True;
                }

                if(isset($_POST['deletepost'])){
                  if (DB::query('SELECT id FROM posts WHERE id=:post_id AND user_id=:user_id', array(':post_id'=>$_GET['post_id'], ':user_id'=>$follower_id))){
                    DB::query('DELETE FROM posts WHERE id=:post_id AND user_id=:user_id', array(':post_id'=>$_GET['post_id'], ':user_id'=>$follower_id));
                    DB::query('DELETE FROM posts_like WHERE post_id = :post_id',array(':post_id'=>$_GET['post_id']));
                    echo "Post deleted";
                  }
                }

                if(isset($_POST['post'])){
                  if($_FILES['postimg']['size'] == 0){
                    Post::createPost($_POST['postbody'], Login::isLoggedIn(), $user_id);
                    // Post::createPost($_POST['postbody'], Login::isLoggedIn(), $user_id);
                  } else {
                    // $postid = Post::createImgPost($_POST['postbody'], Login::isLoggedIn(), $user_id);
                    // Image::uploadImage('postimg', "UPDATE posts SET postimg=:postimg WHERE id=:postid", array(':postid'=>$postid));

                     $post_id = Post::createImgPost($_POST['postbody'], Login::isLoggedIn(), $user_id);
                     Image::uploadImage('postimg', "UPDATE posts SET postimg=:postimg WHERE id=:post_id", array(':post_id'=>$post_id));


                  }


              }

                if(isset($_GET['post_id']) && !isset($_GET['deletepost'])){
                  Post::likePost($_GET['post_id'], $follower_id);
              }

              $posts = Post::displayPosts($user_id, $username, $follower_id);


        } else {
                die('User not found!');
        }
}
?>

  <!DOCTYPE html>
  <html>

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tulime</title>
      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
      <link rel="stylesheet" href="assets/css/Footer-Dark.css">
      <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
      <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
      <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
      <link rel="stylesheet" href="assets/css/styles.css">
      <link rel="stylesheet" href="assets/css/untitled.css">
      <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
  </head>

  <body>
      <header class="hidden-sm hidden-md hidden-lg">
          <div class="searchbox">
              <form>
                  <h1 class="text-left">Tulime</h1>
                  <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                      <input class="form-control sbox" type="text">
                      <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                     </ul>
                  </div>
                  <div class="dropdown">
                      <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                          <li role="presentation"><a href="profile.php">My Profile</a></li>
                          <li class="divider" role="presentation"></li>
                          <li role="presentation"><a href="index.html">Timeline </a></li>
                          <li role="presentation"><a href="messages.html">Messages </a></li>
                          <li role="presentation"><a href="notify.php">Notifications </a></li>
                          <li role="presentation"><a href="#">My Account</a></li>
                          <li role="presentation"><a href="users.php">Users</a></li>
                          <li role="presentation"><a href="logout.php">Logout </a></li>
                      </ul>
                  </div>
              </form>
          </div>
          <hr>
      </header>
      <div>
          <nav class="navbar navbar-default hidden-xs navigation-clean">
              <div class="container">
                  <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="icon ion-ios-navigate"></i></a>
                      <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                  </div>
                  <div class="collapse navbar-collapse" id="navcol-1">
                      <form class="navbar-form navbar-left">
                          <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                              <input class="form-control" type="text">
                          </div>
                      </form>
                      <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                          <li role="presentation"><a href="index.html">My Timeline</a></li>
                          <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                  <li role="presentation"><a href="#">My Profile</a></li>
                                  <li class="divider" role="presentation"></li>
                                  <li role="presentation"><a href="index.html">Timeline </a></li>
                                  <li role="presentation"><a href="messages.html">Messages </a></li>
                                  <li role="presentation"><a href="notify.php">Notifications </a></li>
                                  <li role="presentation"><a href="users.php">Users</a></li>
                                  <li role="presentation"><a href="#">My Account</a></li>
                                  <li role="presentation"><a href="logout.php">Logout </a></li>
                              </ul>
                          </li>
                      </ul>
                      <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                          <li class="active" role="presentation"><a href="index.html">Timeline</a></li>
                          <li role="presentation"><a href="#">Messages</a></li>
                          <li role="presentation"><a href="notify.php">Notifications</a></li>
                          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                              <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                  <li role="presentation"><a href="profile.php">My Profile</a></li>
                                  <li class="divider" role="presentation"></li>
                                  <li role="presentation"><a href="index.html">Timeline </a></li>
                                  <li role="presentation"><a href="messages.html">Messages </a></li>
                                  <li role="presentation"><a href="notify.php">Notifications </a></li>
                                  <li role="presentation"><a href="#">My Account</a></li>
                                  <li role="presentation"><a href="users.php">Users</a></li>
                                  <li role="presentation"><a href="logout.php">Logout </a></li>
                              </ul>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
      </div>
      <div class="container">
          <h1><?php echo $username; ?>'s Profile <?php if($verified) { echo '<i class="glyphicon glyphicon-ok-sign verified" data-toggle="tooltip" title="Verified User" style="font-size:28px;color:#da052b;"></i>';} ?></h1></div>
            <form action="profile.php?username=<?php echo $username; ?>" method="post">
                <?php
                if ($user_id != $follower_id) {
                        if ($isFollowing) {
                                 echo '<input type="submit" name="unfollow" value="Unfollow" style="width:20%;background-color:#069370;color:#fff;padding:16px 32px;margin:0px 90px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">';

                        } else {
                                echo '<input type="submit" name="follow" value="Follow" style="width:20%;background-color:#069370;color:#fff;padding:16px 32px;margin:0px 90px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">';
                        }
                }
                ?>
      </form>

      <div>
          <div class="container">
              <div class="row">
                  <div class="col-md-3">
                      <ul class="list-group">
                          <li class="list-group-item"><span><strong>About Me</strong></span>
                              <p>Welcome to my profile bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;</p>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-6">
                      <ul class="list-group">
                        <div class="timelineposts">
                        </div>
                      </ul>
                  </div>
                  <div class="col-md-3">
                      <button class="btn btn-default" type="button" style="width:100%;background-image:url(&quot;none&quot;);background-color:#069370;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" onclick="showNewPostModal()">NEW POST</button>

                      <ul class="list-group"></ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="commentsmodal" role="dialog" tabindex="-1" style="padding-top:100px;">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Comments</h4></div>
                  <div class="modal-body" style="max-height: 400px; overflow-y: auto">
                      <p>The content of your modal.</p>
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="newposts" role="dialog" tabindex="-1" style="padding-top:100px;">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">New post</h4></div>
                  <div style="max-height: 400px; overflow-y: auto">
                    <form action="profile.php?username=<?php echo $username; ?>" method="post" enctype="multipart/form-data">
                      <textarea name="postbody" rows="8" cols="80"></textarea>
                      <br/>Upload an image:
                      <input type="file" name="postimg">
                  </div>
                  <div class="modal-footer">
                      <input type="submit" name="post" value="Post" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#069370;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>

                  </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer-dark">
          <footer>
              <div class="container">
                  <p class="copyright">Tulime© 2019</p>
              </div>
          </footer>
      </div>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/bs-animation.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
      <script type="text/javascript">

            function scrollToAnchor(aid){
              var aTag = $(aid);
              $('html,body').animate({scrollTop: aTag.offset().top},'slow');
            }

              $(document).ready(function() {
                // $.ajax({
                //         type: "GET",
                //         url: "api/users?user_id=" + $(this).attr('data-user_id'),
                //         processData: false,
                //         contentType: "application/json",
                //         data: '',
                //         success: function(r) {
                //                 var res = JSON.parse(r)
                //                 showCommentsModal(res);
                //         },
                //         error: function(r) {
                //                       console.log(r)
                //               }
                //           });
                //   });


                $('.sbox').keyup(function() {
                            $('.autocomplete').html("")
                            $.ajax({
                                    type: "GET",
                                    url: "api/search?query=" + $(this).val(),
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function(r) {
                                            r = JSON.parse(r)
                                            for (var i = 0; i < r.length; i++) {
                                                    console.log(r[i].body)
                                                    $('.autocomplete').html(
                                                            $('.autocomplete').html() +
                                                            '<a href="profile.php?username='+r[i].username+'#'+r[i].id+'"><li class="list-group-item"><span>'+r[i].body+'</span></li></a>'

                                                    )
                                            }
                                    },
                                    error: function(r) {
                                            console.log(r)
                                    }
                            })
                    })

                  $.ajax({
                          type: "GET",
                          url: "api/profileposts?username=<?php echo $username; ?>",
                          processData: false,
                          contentType: "application/json",
                          data: '',
                          success: function(r) {
                                  var posts = JSON.parse(r)
                                  $.each(posts, function(index) {
                                    if (posts[index].PostImage == "") {
                                               $('.timelineposts').html(
                                                       $('.timelineposts').html() +
                                                       '<li class="list-group-item" id="'+posts[index].PostId+'"><blockquote><p>'+posts[index].PostBody+'</p><footer>Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"'+posts[index].PostId+'\"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+posts[index].Likes+' Likes</span></button><button class="btn btn-default comment" data-post_id=\"'+posts[index].PostId+'\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer></blockquote></li>'
                                               )
                                       } else {
                                               $('.timelineposts').html(
                                                       $('.timelineposts').html() +
                                                       '<li class="list-group-item" id="'+posts[index].PostId+'"><blockquote><p>'+posts[index].PostBody+'</p><img src="" data-tempsrc="'+posts[index].PostImage+'" class="postimg" id="img'+posts[index].postId+'"><footer>Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"'+posts[index].PostId+'\"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+posts[index].Likes+' Likes</span></button><button class="btn btn-default comment" data-post_id=\"'+posts[index].PostId+'\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer></blockquote></li>'
                                               )
                                       }

                                          $('[data-post_id]').click(function() {
                                                  var buttonid = $(this).attr('data-post_id');
                                                  $.ajax({
                                                          type: "GET",
                                                          url: "api/comments?post_id=" + $(this).attr('data-post_id'),
                                                          processData: false,
                                                          contentType: "application/json",
                                                          data: '',
                                                          success: function(r) {
                                                                  var res = JSON.parse(r)
                                                                  showCommentsModal(res);
                                                          },
                                                          error: function(r) {
                                                                  console.log(r)
                                                          }
                                                  });
                                          });
                                          $('[data-id]').click(function() {
                                                  var buttonid = $(this).attr('data-id');
                                                  $.ajax({
                                                          type: "POST",
                                                          url: "api/likes?id=" + $(this).attr('data-id'),
                                                          processData: false,
                                                          contentType: "application/json",
                                                          data: '',
                                                          success: function(r) {
                                                                  var res = JSON.parse(r)
                                                                  $("[data-id='"+buttonid+"']").html(' <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.Likes+' Likes</span>')
                                                          },
                                                          error: function(r) {
                                                                  console.log(r)
                                                          }
                                                  });
                                          })
                                  })

                                  $('.postimg').each(function(){
                                    this.src=$(this).attr('data-tempsrc')
                                    this.onload =function(){
                                      this.style.opacity = '1';
                                    }

                                  })

                                  scrollToAnchor(location.hash)
                          },
                          error: function(r) {
                                  console.log(r)
                          }
                  });
          });

          function showNewPostModal(){
              $('#newposts').modal('show')

          }
          function showcommentsModal(res) {
                  $('#commentsmodal').modal('show')
                  var output = "";
                  for (var i = 0; i < res.length; i++) {
                          output += res[i].Comment;
                          output += " ~ ";
                          output += res[i].CommentedBy;
                          output += "<hr />";
                  }
                  $('.modal-body').html(output)
          }
      </script>
  </body>

  </html>

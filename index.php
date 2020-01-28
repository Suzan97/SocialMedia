
<?php
ini_set('display_errors', '1');
include('./database/DB.php');
include('./Login/Login.php');
include('./database/post.php');
include('./database/Comment.php');


$showTimeline = False;
if(Login::isLoggedIn()) {
  $user_id = Login::isLoggedIn();
  $showTimeline = True;

}else{
  die("<script type='text/javascript'> alert(' Not logged in!');
        setTimeout(
                 function(){
                           window.location.href = 'login.php';
                                },10
                                    );

                                         </script>");

}
if(isset($_GET['post_id'])){
  Post::likePost($_GET['post_id'], $user_id);
}
if (isset($_POST['comment'])) {
        Comment::createComment($_POST['commentbody'], $_GET['post_id'], $user_id);
}
if (isset($_POST['searchbox'])) {
        $tosearch = explode(" ", $_POST['searchbox']);
        if (count($tosearch) == 1) {
                $tosearch = str_split($tosearch[0], 2);
        }
        $whereclause = "";
        $paramsarray = array(':username'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
               $whereclause .= " OR username LIKE :u$i ";
               $paramsarray[":u$i"] = $tosearch[$i];
        }

       $users = DB::query('SELECT users.username From users WHERE users.username LIKE :username '. $whereclause.'', $paramsarray);
       print_r($users);

       $whereclause = "";
       $paramsarray = array(':body'=>'%'.$_POST['searchbox'].'%');
       for ($i = 0; $i < count($tosearch); $i++) {
         if($i % 2 ){
              $whereclause .= " OR body LIKE :p$i ";
              $paramsarray[":p$i"] = $tosearch[$i];
            }
       }
       $posts = DB::query('SELECT posts.body From posts WHERE posts.body LIKE :body '. $whereclause.'', $paramsarray);
       echo '<pre>';
       print_r($posts);
       echo '<pre>';

}
?>

<form action="index.php" method="post">
  <input type="text" name="searchbox" value="">
  <input type="submit" name="search" value="search">
</form>

<?php

$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, users.username FROM users,posts,followers
WHERE posts.user_id=followers.user_id
AND users.user_id = posts.user_id
AND follower_id= :user_id
ORDER BY posts.likes DESC;', array(':user_id'=>$user_id));


  foreach($followingposts as $posts) {

      echo $posts['body']." ~ ".$posts['username'];

      echo "<form action='index.php?post_id=".$posts['id']."' method='post'>";
      if(!DB::query('SELECT post_id FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$posts['id'], ':user_id'=>$user_id))){

      echo"<input type='submit' name='like' value='like'>";
      }else{
        echo"<input type='submit' name='Unlike' value='Unlike'>";
      }
      echo "<span>".$posts['likes']." likes</span>
      </form>
      <form action='index.php?post_id=".$posts['id']."' method='post'>
      <textarea name='commentbody' rows='3' cols='50'></textarea>
      <input type='submit' name='comment' value='Comment'>
      </form>";
      Comment::displayComments($posts['id']);
      echo "
      <hr/><br/>";


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
                            <input class="form-control sbox" type="text">
                            <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                            </ul>
                        </div>
                    </form>
                    <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                        <li role="presentation"><a href="profile.php">My Timeline</a></li>
                        <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
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
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                        <li class="active" role="presentation"><a href="index.html">Timeline</a></li>
                        <li role="presentation"><a href="messages.html">Messages</a></li>
                        <li role="presentation"><a href="notify.php">Notifications</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="profile.php">My Profile</a></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="index.html">Timeline </a></li>
                                <li role="presentation"><a href="messages.html">Messages </a></li>
                                <li role="presentation"><a href="notify.php">Notifications </a></li>
                                <li role="presentation"><a href="#">My Account</a></li>
                                <li role="presentation"><a href="logout.php">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <h1>Timeline </h1>
        <div class="timelineposts">

        </div>
    </div>
    <div class="modal fade" id=comment role="dialog" tabindex="-1" style="padding-top:100px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Comments</h4></div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto">
                    <p>The content of your modal.</p>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-default" type="button" style="width:100%;background-image:url(&quot;none&quot;);background-color:#069370;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" onclick="showNewCommentModal()">Comment</button>

                    <ul class="list-group"></ul>
                </div>



                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newcomment" role="dialog" tabindex="-1" style="padding-top:100px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">add comment</h4></div>
                <div style="max-height: 400px; overflow-y: auto">
                  <form action="index.html" method="post" enctype="multipart/form-data">
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
    <div class="footer-dark navbar-fixed-bottom" style="position: fixed">
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

        //         $.ajax({
        //                 type: "GET",
        //                 url: "api/posts",
        //                 processData: false,
        //                 contentType: "application/json",
        //                 data: '',
        //                 success: function(r) {
        //                         var posts = JSON.parse(r)
        //                         $.each(posts, function(index) {
        //                                 $('.timelineposts').html(
        //                                         $('.timelineposts').html() + '<blockquote><p>'+posts[index].PostBody+'</p><footer>Posted by '+posts[index].PostedBy+' on '+posts[index].PostDate+'<button class="btn btn-default" data-id="'+posts[index].PostId+'" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"> <i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+posts[index].Likes+' Likes</span></button><button class="btn btn-default comment" type="button" data-post_id="'+posts[index].PostId+'" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer></blockquote>'
        //                                 )
        //                                 $('[data-post_id]').click(function() {
        //                                         var buttonid = $(this).attr('data-post_id');
        //                                         $.ajax({
        //                                                 type: "GET",
        //                                                 url: "api/comments?post_id=" + $(this).attr('data-post_id'),
        //                                                 processData: false,
        //                                                 contentType: "application/json",
        //                                                 data: '',
        //                                                 success: function(r) {
        //                                                         var res = JSON.parse(r)
        //                                                         showCommentsModal(res);
        //                                                 },
        //                                                 error: function(r) {
        //                                                         console.log(r)
        //                                                 }
        //                                         });
        //                                 });
        //                                 $('[data-id]').click(function() {
        //                                         var buttonid = $(this).attr('data-post_id');
        //                                         $.ajax({
        //                                                 type: "POST",
        //                                                 url: "api/likes?post_id=" + $(this).attr('data-post_id'),
        //                                                 processData: false,
        //                                                 contentType: "application/json",
        //                                                 data: '',
        //                                                 success: function(r) {
        //                                                         var res = JSON.parse(r)
        //                                                         $("[data-post_id='"+buttonid+"']").html('<i class="glyphicon glyphicon-heart" data-aos="flip-right"></i><span> '+res.likes+' Likes</span>')
        //                                                 },
        //                                                 error: function(r) {
        //                                                         console.log(r)
        //                                                 }
        //                                         });
        //                                 })
        //                         })
        //                 },
        //                 error: function(r) {
        //                         console.log(r)
        //                 }
        //         });
        // });
        // function showNewCommentModal(){
        //     $('#newcomment').modal('show')
        //
        // }
        // function showCommentsModal(res) {
        //         $('#comment').modal('show')
        //         var output = "";
        //         for (var i = 0; i < res.length; i++) {
        //                 output += res[i].Comment;
        //                 output += " ~ ";
        //                 output += res[i].CommentedBy;
        //                 output += "<hr />";
        //         }
        //         $('.modal-body').html(output)
        // }
    </script>
</body>

</html>

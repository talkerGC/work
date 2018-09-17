<!-- 也可以使用 $_SERVER['PHP_SELF'] 取代 $current_page -->
<?php


require_once '../functions.php';
$current_page = isset($current_page) ? $current_page : '';
$current_user = xiu_get_current_user();

?>
<div class="aside">
  <div class="profile">
    <img class="avatar" src="<?php echo $current_user['avatar']; ?>">
    <h3 class="name"><?php echo $current_user['nickname']; ?></h3>
  </div>
  <ul class="nav">
    <li<?php echo $current_page === 'index' ? ' class="active"' : '' ?>>
      <a href="/admin/index.php"><i class="fa fa-dashboard"></i>Dashboard</a>
    </li>
    <?php $menu_posts = array('posts', 'post-add', 'categories'); ?>
    <li<?php echo in_array($current_page, $menu_posts) ? ' class="active"' : '' ?>>
      <a href="#menu-posts"<?php echo in_array($current_page, $menu_posts) ? '' : ' class="collapsed"' ?> data-toggle="collapse">
        <i class="fa fa-thumb-tack"></i>Artical<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-posts" class="collapse<?php echo in_array($current_page, $menu_posts) ? ' in' : '' ?>">
        <li<?php echo $current_page === 'posts' ? ' class="active"' : '' ?>><a href="/admin/posts.php">all-artical</a></li>
        <li<?php echo $current_page === 'post-add' ? ' class="active"' : '' ?>><a href="/admin/post-add.php">write-something</a></li>
        <li<?php echo $current_page === 'categories' ? ' class="active"' : '' ?>><a href="/admin/categories.php">classification</a></li>
      </ul>
    </li>
    <li<?php echo $current_page === 'comments' ? ' class="active"' : '' ?>>
      <a href="/admin/comments.php"><i class="fa fa-comments"></i>About</a>
    </li>
    <li<?php echo $current_page === 'users' ? ' class="active"' : '' ?>>
      <a href="/admin/users.php"><i class="fa fa-users"></i>Users</a>
    </li>
    <?php $menu_settings = array('nav-menus', 'slides', 'settings'); ?>
    <li<?php echo in_array($current_page, $menu_settings) ? ' class="active"' : '' ?>>
      <a href="#menu-settings"<?php echo in_array($current_page, $menu_settings) ? '' : ' class="collapsed"' ?> data-toggle="collapse">
        <i class="fa fa-cogs"></i>Setting<i class="fa fa-angle-right"></i>
      </a>
      <ul id="menu-settings" class="collapse<?php echo in_array($current_page, $menu_settings) ? ' in' : '' ?>">
        <li<?php echo $current_page === 'nav-menus' ? ' class="active"' : '' ?>><a href="/admin/nav-menus.php">Navigation</a></li>
        <li<?php echo $current_page === 'slides' ? ' class="active"' : '' ?>><a href="/admin/slides.php">Carousel</a></li>
        <li<?php echo $current_page === 'settings' ? ' class="active"' : '' ?>><a href="/admin/settings.php">website</a></li>
      </ul>
    </li>
  </ul>
</div>

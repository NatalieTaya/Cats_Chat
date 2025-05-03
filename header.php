<header>
    <h2 class="header_name">Cat Chat</h2>
    <?php  if (isset($_COOKIE['key'])):  ?>
        <form class="exit_btn" method="post">
        <button type="submit" name="submitExit">Exit</button>
        </form>
    <?php endif; ?>
</header>
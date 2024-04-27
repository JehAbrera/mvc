<nav id="navbar" class=" z-50 fixed top-0 left-0 w-full flex flex-row items-center justify-between text-zinc-100">
    <div id="logo-area" class=" flex flex-row gap-2 items-center p-2 font-extrabold text-xl"><i data-lucide="sun" class=" stroke-[3]"></i>Sunset City</div>
    <div id="nav-area">
        <ul class=" menu menu-horizontal flex flex-row items-center">
            <li><a href="index.php">Home</a></li>
            <?php
            $page = substr($_SERVER['SCRIPT_NAME'], 1);

            if ($page != "mvc/app/view/form.php") { ?>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contacts</a></li>
                <li><a href="form.php" class=" btn btn-accent">Reserve Now</a></li>
            <?php }
            ?>
        </ul>
    </div>
</nav>
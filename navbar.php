


<style>
    *{
 margin:  0 ;
 padding: 0;
 box-sizing: border-box;
 font-family: sans-serif;
}

nav{
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 20px;
    font-family: sans-serif;
    padding: 20px;
    width: 100%;
    height: 70px;
    position: sticky;
    background: orange;
    /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); */
    /* border: 1px solid red; */
    
}
.menu{
    display: flex;
    list-style: none;
    
}
.menu li{
    margin-left:100px;

}
a{
   text-decoration: none; 
}
nav a{
    color: aliceblue;
}
</style>


<body>
    
        <nav>
            <div class="logo">
                <a href="index.php"><img src="./imgs/logo-bg.png" alt="GAMER SHOP" width="100px"></a>
            </div>

            <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Info</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contract</a></li>
            </ul>
            
            <?php if($_SESSION['Name_login'] != ''){?>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Name_login'];?></span>
                        <img class="img-profile rounded-circle" src="imgs/logo.png" width="50px">
                    </a>
                    
                        <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                        </a>
                    
                </li>
            <?php }else{?>
             
            <div class="login">
                <a href="login.php">Login</a>
            </div>
            <?php }?>
        </nav>
    
    
</body>

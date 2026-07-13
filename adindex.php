<?php
 session_start();
 if(!isset($_SESSION['AdminLoginId']))
    {
       header("location: try.html");
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale1=1.0">
        <title>dashboard</title>
        <!--fontawsome link-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

        <style>

@import url('https://fonts.googleapis.com/css?family=Poppins:wgh@100;200;300;400;500;600;700;800;900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins', sans-serif;
}

body{
    width: 100%;
    background: #E5E7EB;
    position: relative;
    display: flex;
}

#menu{
    background:rgb(5, 70, 13);
    width: 300px;
    height: 750px;
}

#menu .logo{
    display: flex;
    align-items: center;
    color: #fff;
    padding: 30px 0 0 30px;
}

#menu .logo img{
    width: 45px;
    margin-right: 15px;
}

#menu .items{
    margin-top: 40px;
}

#menu .items li{
    list-style: none;
    padding: 15px 0;
    transition: 0.3s ease;
}


#menu .items li:hover{
    background: #5d0c61;
    cursor: pointer;
}

#menu .items li:nth-child(1){
    border-left: 4px solid #fff;
}

#menu .items li i{
    color: rgb(134, 141, 151);
    width: 39px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 14px;
    margin: 0 10px 0 25px;
}

#menu .items li:hover i,
#menu .items li:hover a{
    color: #f3f4f6;
}

#menu .items li a{
    text-decoration: none;
    color: rgb(134, 141, 151);
    font-weight: 300px;
    transition: 0.3s ease;
}

#interface{
    width: calc(100% -  300px);
}

#interface .navigation{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    padding: 15px 50px;
    border-bottom: 3px solid #594ef7;
}

#interface .navigation .search{
 display: flex;
 justify-content: flex-start;
 align-items: center;
 padding: 10px 14px;
 border: 1px solid #d7dbe6;
 border-radius: 4px;
}

#interface .navigation .search i{
    margin-right: 14px;
}

#interface .navigation .search input{
    border: none;
    outline: none;
    font-size: 14px;
}


#interface .navigation .profile button{
    
    background-color:rgb(170, 210, 170);
    font-size: 12px;
    font-weight: 500;
    padding: 8px 12px;
    border: 3px solid black;
    object-fit: cover;
    border-radius: 50px;
}


/*user list admin*/

#interface h3{
    padding:3% 0 0 3%;
    
}

#interface .pop{
    border-collapse: collapse;
    align-items: center;
    padding: 15% 0 0 19%;
    justify-content: center;
    height: 10%;

}

#interface .pop th{
    background: rgb(247, 189, 224);
}

#interface .pop td{
    font-size: 1.2rem;
    text-align: center;
    
    
}

#interface .us{
    padding: 3% 0 0 10%;
    color:#d46cd9;
}

 /*appointment list admin*/

 #interface .pup{
    border-collapse: collapse;
    align-items: center;
    padding: 17% 0 0 5%;
    justify-content: center;
    height: 10%;

}

#interface .pup th{
    background: rgb(54, 88, 50);
}



#interface .pup td{
    font-size: 1.2rem;
    text-align: center;
     
}

#interface .us{
    padding: 3% 0 0 10%;
    color:#d46cd9;
}

#interface form input{
    padding:1px;
}
            </style>
    </head>

     <body>
           <section id="menu">
            <div class="logo">
                <img src="image/logo.png" alt="">
                <h2>AgriBazar</h2>
            </div>

            <div class="items">
                <li><i class="fa-solid fa-chart-pie"></i><a href="adindex.php">Dashboard</a></li>
                <li><i class="fa-solid fa-user-tie"></i><a href="delete.php">users</a></li>
                <li><i class="fa-solid fa-calendar-check"></i><a href="#">product</a></li>
                <li><i class="fa-solid fa-list"></i><a href="#"></a></li>
            </div>
           </section>

           <section id="interface">
            <div class="navigation">
                <div class="n1">
                      <div class="search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="search">

                      </div>
                </div>
                 <div class="profile">
                 <form method="POST">
                    <button name="Logout">LOG OUT</button>
                    </form>
                 </div>
            </div>
                
              <h3>Dashboard</h3>

           </section>

           <?php
               if(isset($_POST['Logout']))
               {
                session_destroy();
                header("location: try.html");
               }
            ?>


     </body>

</html>
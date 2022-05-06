<header>
    <div class="layer_user" style="position:fixed;width:100%;height:100%;background-color:black;opacity:0.5;z-index:149" hidden></div>
        <div class="page-container">
        <div class="spinner-border text-light" id="imgSpinner1" role="status" style="position:fixed;top:45%;right:55%" hidden>
            <span class="sr-only">Loading...</span>
        </div>
         <div id="header_options">
                    <!-- <select id="language" is="ms-dropdown">
                            <option id="es" data-tr="Español" data-image="view/img/language_logo/spain-logo.png">Español</option>
                            <option id="ca" data-tr="Catalán" data-image="view/img/language_logo/catalán-logo.png">Catalán</option>
                            <option id="en" data-tr="Inglés" data-image="view/img/language_logo/Britanica-logo.jpg">Inglés</option>            
                    </select> -->
        <div id="space_logger">
        </div>
    </div>

    <!-- menu desplegable bootstrap -->
    <div class="container">
        <nav class="col-md-12 col-xs-12 menu">
            <ul>
                <li class="logo">
                    <img style="width:100px;height:100px" src="./view/img/logo_autoshell.png"></img>   
                </li>
                <li class="button_menu">
                    <a href="home">
                        <span><i class="fas fa-home fa-3x"></i></span>
                    </a>
                </li>
                <li class="button_menu">
                    <a href="shop">
                        <span><i class="fas fa-car fa-3x"></i></span>
                    </a>
                </li>
                <li class="button_menu">
                    <a href="contact">
                        <span><i class="fas fa-address-book fa-3x"></i></span>
                    </a>
                </li>
                <li class="space">
                </li>
                <li class="search_inputs">
                    <i class="fas fa-gas-pump fa-3x"></i>
                    <select id="select_type_header">
                            <option value="0">--</option>
                    </select>
                </li>
                <li class="search_inputs">
                    <i class="fas fa-car fa-3x"></i>
                    <select id="select_brand_header">
                        <option value="0">--</option>
                    </select>
                </li>
                <li class="search_inputs_text">                        
                    <input type="text" id="autocom" maxlength="20" style="width: 350px;" autocomplete="off"/>
                    <div id="search_auto" style="background-color: white;opacity: 0.8;color: black;z-index: 102;position: fixed;width: 400px"></div>
                    <button class="send_information_header"><i class="fas fa-search fa-2x"></i></button>
                </li>
                <li class="panel_user">
                    <div id="default_panel" class="default_panel_user">
                    </div>
                </li>
    </div>
</header>
<div id="panel_register">
    <span id="user_login_close"><i class="fas fa-window-close fa-2x"></i></span>
    <?php
        include( Login_view . "/login.html");
        include( Login_view . "/register.html");
    ?>
</div>

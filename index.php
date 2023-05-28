<?php

    session_start();

    require_once ('products/Controladores/Productos.php');

    $objProdCont = new ProdCont();

    require_once ('usuarios/Controladores/Usuarios.php');

    $objUsrCont = new UsrCont();

    require_once ('cart/Controladores/Cart.php');
    require_once ('cart/Vista/Cart.php');

    $objCartCont = new CartCont();
    $objCartView = new CartView();

    require_once ('ticket/Controladores/Ticket.php');
    require_once ('ticket/Vista/Ticket.php');

    $objTicketCont = new TicketCont();
    $objTicketView = new TicketView();

    if(!isset($_GET['accion'])){
        $_GET['accion'] = 'galeria';
    }
    if(isset($_GET['accion'])){
        switch($_GET['accion']){
            case 'galeria':
                $objProdCont->lista();
                break;
            case 'login':
                $objUsrCont->inc();
                break;
            case 'logout':
                $objProdCont->lista();
                break;
            case 'cart':
                $objCartView->Carrito($objCartCont->createCart());
                break;
            case 'ticket':
                $objTicketView->Ticket($objTicketCont->createTicket());
                break;
            case 'agregar':
                if(isset ($_GET['item'])){
                    $objCartView->Carrito($objCartCont->add($_GET['item']));
                }
                break;
            case 'reducir':
                if(isset ($_GET['item'])){
                    $objCartView->Carrito($objCartCont->reducir($_GET['item']));
                }
                break;
            case 'vaciar':
                $objCartCont->vaciar();
                $objProdCont->lista();
                break;
        }
    }
    
    if(isset($_POST['in'])){
        switch($_POST['in']){
            case 'iniciar':
                $objUsrCont->iniciar_Sesion($_POST['a'], $_POST['b']);
                session_start();
                break;
        }
    }

<?php
//Set $title
require 'layouts/set_title.php';
//Koneksi kedalam database
require 'fungsi/koneksi.php';
require 'fungsi/cek.php';

?>


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $pg_title ?></title>
    <link rel="icon" type="image/x-icon" href="dist/assets/img/favicon.png" />


    <link type="text/css" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
        rel="stylesheet" />
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />

    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"
        rel="stylesheet" type="text/css" />
    <!-- <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous">
    </script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- CSS file -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css"> -->



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />
    <!-- CSS FOR: SEARCHABLE DROPDOWN -->
    <!-- <link type="text/css" href="dist/css/choices.js.9.0.1/choices.min.css" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" /> -->



    <!-- <link type="text/css" href="dist/css/autocomplete.jsv10.2.7/autoComplete.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css">



    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>



    <link type="text/css" href="dist/css/styles.css" rel="stylesheet" />
    <link type="text/css" href="dist/css/custom_tom_select.css" rel="stylesheet" />


    <style>
    /*  */
    /* CUST CSS: TABLE TD - ALIGN MIDDLE */
    /*  */
    th {
        text-align: start !important;
        vertical-align: middle !important;
    }

    td {
        vertical-align: middle !important;
    }


    /*  */
    /* CUST CSS: MAXIMIZE, MINIMIZE, AND FULLSCREEN CARD */
    /*  */
    .full_screen {
        width: 100vw;
        position: fixed;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    #media_wrapper {
        transform: scale(1, 1);
        object-fit: cover;
    }


    /*  */
    /* CUST CSS: MENU TABLE BUTTON */
    /*  */
    .btn-menutable {
        height: fit-content !important;
        width: fit-content !important;
        padding: 8pt !important;
        font-size: 0.75rem;
        border-radius: 0.35rem !important;
    }

    .btn-menutable {
        background-color: var(--bs-gray-500) !important;
    }

    .btn-menutable:hover {
        background-color: #00ac69 !important;
    }



    /*  */
    /* CUST CSS: Feather Icons */
    /*  */
    .fi-ic-red {
        color: #e81500;
    }

    .fi-ic-blue {
        color: #0061f2;
    }

    .fi-ic-cyan {
        color: #0061f2;
    }

    .fi-ic-green {
        color: #00ac69;
    }

    .fi-ic-yellow {
        color: #f4a100;
    }

    .fi-ic-gray {
        color: #69707a;
    }
    </style>



</head>
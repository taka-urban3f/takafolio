<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <link rel="stylesheet" href="css/destyle.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="icon" href="img/favicon.ico"> -->

    <noscript>
        <style>
            .l-loading {
                display: none;
            }
        </style>
    </noscript>
    <?php wp_head(); ?>
</head>

<body data-barba="wrapper" <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="l-wrapper">
        <div class="l-loading">
            <p class="l-loading__text">now loading・・・</p>
        </div>
        <header class="l-header">
            <div class="l-header__inner">
                <div class="l-header__cntTitle">
                    <a href="index.html">
                        <h1 class="l-header__title">TAKAFOLIO</h1>
                        <span class="l-header__subTitle">The Takahiro's portfolio site</span>
                    </a>
                </div>
                <nav class="l-header__gNav">
                    <ul class="l-header__navList">
                        <li class="l-header__navList__item"><a href="/index.html#secWorks">works</a></li>
                        <li class="l-header__navList__item"><a href="/index.html#secSkill">skill</a></li>
                        <li class="l-header__navList__item"><a href="/index.html#secAbout">about</a></li>
                    </ul>
                </nav>
                <button class="l-header__humBtn">
                    <span class="l-header__humBtn__line"></span>
                    <span class="l-header__humBtn__caption">menu</span>
                </button>
            </div>
            <nav class="l-header__humMenu">
                <ul class="l-header__humMenu__list">
                    <li class="l-header__humMenu__list__item"><a href="/index.html#secWorks">works</a></li>
                    <li class="l-header__humMenu__list__item"><a href="/index.html#secSkill">skill</a></li>
                    <li class="l-header__humMenu__list__item"><a href="/index.html#secAbout">about</a></li>
                    <button class="l-header__humMenu__closeBtn">
                        <span class="l-header__humMenu__closeBtn__line"></span>
                        <span class="l-header__humMenu__closeBtn__caption">close</span>
                    </button>
                </ul>
            </nav>
        </header>

'use strict';

//サイトトップURLを保持
// const site_url = 'http://192.168.1.5:5500'; //サブディレクトリにサイトを設置する場合はディレクトリまで指定
const site_url = location.origin; //ドメイントップに単一のサイトを設置する場合はこれでもOK

//同一サイト内から遷移してきた場合はフラグを立てる。
const ref = document.referrer;
let flag_same_site = 0;
if (ref.includes(site_url)) {
    flag_same_site = 1;
}

// 指定したパスを含むURLの場合だけスプラッシュアニメーションを実行するフラグを立てる
const paths = ['/', '/index.html'];
const lochref = location.href;
let flag_do_splash = 0;
for (const path of paths) {
    const url = site_url + path;
    if (lochref.includes(url)) {
        flag_do_splash = 1;
        break;
    }
}

//ローディング画面の最小表示時間をミリ秒で設定
const minLoadingTime = 1000;

//ローディング時間の計測に使用
const date = new Date();
const loadingStart = date.getTime();

//--------------------------------------------------------------------------------------------
//マウスホイールとスワイプを不可にする処理（ロード後に解除）
//--------------------------------------------------------------------------------------------
function noscroll(e) {
    e.preventDefault();
}

document.addEventListener('touchmove', noscroll, {
    passive: false
});
document.addEventListener('wheel', noscroll, {
    passive: false
});

//--------------------------------------------------------------------------------------------
//lenis初期化
//--------------------------------------------------------------------------------------------
const lenis = new Lenis({
    lerp: 0.2,
    duration: 0.5,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

//--------------------------------------------------------------------------------------------
//barba初期化
//--------------------------------------------------------------------------------------------
// 指定した要素内にある、WPが動的生成したページネーション内リンクにシームレス遷移を適用する
function paginationAnchorSetting(elem_ctn) {
    const elems_pagination_anchor = elem_ctn.querySelectorAll('.navigation.pagination>.nav-links>a');
    if (elems_pagination_anchor.length !== 0) {
        elems_pagination_anchor.forEach(function (elem) {
            elem.classList.add('js-do-barba');
        });
    }
}
paginationAnchorSetting(document);

if (typeof barba !== 'undefined' && document.querySelector('[data-barba="container"]') !== null) {
    barba.init({
        prevent: ({
            el,
        }) => {
            //js-do-barbaクラスが設定されているリンクのみ非同期遷移を有効にする
            if (!el.classList.contains('js-do-barba')) {
                return true;
            }
        },
        transitions: [{
            name: 'default',
            leave: function (data) {
                return gsap.to(data.current.container, {
                    opacity: 0,
                    scale: 0.8,
                    ease: "expo.out",
                    duration: 0.4,
                    onComplete: function () {
                        data.current.container.style.display = 'none'
                    },
                });
            },
            enter: function (data) {
                paginationAnchorSetting(data.next.container);

                return gsap.from(data.next.container, {
                    opacity: 0,
                    scale: 0.8,
                    ease: "expo.out",
                    duration: 0.4,
                });
            },
        }, ],
    });
}

//--------------------------------------------------------------------------------------------
//ローディング画面を消す処理
//--------------------------------------------------------------------------------------------
function LoadingToMain() {
    // マウスホイールとスワイプを可能にする
    document.removeEventListener('touchmove', noscroll);
    document.removeEventListener('wheel', noscroll);

    //選択中のカテゴリーを表すフレームの初期位置設定
    const elem_active = document.querySelector('.js_active_ctg');
    if (elem_active) {
        set_frame(elem_active, 0);
    }

    //ローディング画面を消す
    if (document.querySelector('.l-loading')) {
        const tl = gsap.timeline();
        tl.to('.l-loading', {
            opacity: 0,
            duration: 0.5,
        }).to('.l-loading', {
            display: 'none',
        });
    }

    // lenis始動
    requestAnimationFrame(raf);
}

//--------------------------------------------------------------------------------------------
//スプラッシュアニメーション
//--------------------------------------------------------------------------------------------
function splashAnim() {
    // ヘッダー要素の本来の高さを保持
    const header_height = document.querySelector('.l-header').clientHeight;
    // ヘッダー枠の本来の高さを保持
    const innner_height = document.querySelector('.l-header__inner').clientHeight;

    // タイトルのみを囲うのに必要な枠の幅を計算
    const paddingLeft = window.getComputedStyle(document.querySelector('.l-header__inner')).paddingLeft;
    const frame_width = document.querySelector('.l-header__cntTitle').clientWidth + parseInt(paddingLeft) * 2;

    //スプラッシュアニメーションの為に初期状態設定
    gsap.set('.l-header', {
        height: '100vh',
    });

    gsap.set('.l-header__inner', {
        top: '-100px',
        left: '50%',
        x: '-50%',
        width: 0,
        height: 0,
    });

    gsap.set('.l-header__title', {
        opacity: 0,
        y: '-50%',
    });

    gsap.set('.l-header__subTitle', {
        opacity: 0,
        x: '-50%',
    });

    gsap.set('.l-header__navList__item', {
        opacity: 0,
        y: '-100%',
    });

    gsap.set('.l-header__humBtn', {
        opacity: 0,
        y: '-100%',
    });

    // 一連のアニメーション
    const tl = gsap.timeline();
    tl.set('.l-header__inner', {
        //枠を登場とともに回転させるため、予めマイナス設定
        rotation: -360,
    }).to('.l-header__inner', {
        //枠を上から下ろし、画面の中心で停止
        rotation: 0,
        top: window.innerHeight / 2,
        left: '50%',
        x: '-50%',
        y: '-50%',
        width: '100px',
        height: '100px',
        duration: 1,
        ease: 'power1.out',
    }).to('.l-header__inner', {
        //文字が入る為に丁度良い大きさに変化
        height: innner_height,
        width: frame_width,
        duration: 1,
        ease: 'power1.inOut',
    }, '-=0.2').to('.l-header__title', {
        //文字が入る
        opacity: 1,
        y: 0,
        ease: 'power1.out',
    }).to('.l-header__subTitle', {
        //文字が入る
        opacity: 1,
        x: 0,
        ease: 'power1.out',
    }, '-=0.1').to('.l-header__inner', {
        //枠を所定の位置に移動
        top: 15,
        left: 0,
        x: 0,
        y: 0,
        delay: 0.3,
        duration: 0.7,
        ease: 'power2.out',
    }).to('.l-header__inner', {
        //枠を所定の幅に広げる
        width: '100%',
        duration: 1,
    }).to('.l-header', {
        //ヘッダーの高さを元に戻す
        height: header_height,
        duration: 0.7,
        ease: 'power2.out',
    }, '<').to('.l-header__navList__item', {
        //メニュー表示
        opacity: 1,
        y: 0,
        ease: 'power3.out',
        stagger: {
            each: 0.1
        },
    }).to('.l-header__humBtn', {
        //ハンバーガーボタン表示
        opacity: 1,
        y: 0,
        ease: 'power3.out',
        stagger: {
            each: 0.1
        },
    }, '<').to('.l-header', {
        //CSSでのheight設定を活かすため、height属性を削除。
        //CSSではレスポンシブの為にvwを利用し動的に値が変化
        height: null,
    }).to('.l-header__inner', {
        //CSSでのheight設定を活かすため、height属性を削除。
        //CSSではレスポンシブの為にvwを利用し動的に値が変化
        height: null,
    }, '<');
}

//--------------------------------------------------------------------------------------------
//ターゲット要素を囲うようにフレームのサイズ・位置を計算し
//GSAPで滑らかにCSS変数を変化させ、疑似要素のフレームを操作
//--------------------------------------------------------------------------------------------
//CSSプロパティを取得する為にルートエレメントを取得
const elem_root = document.querySelector(':root');
const cs_root = getComputedStyle(elem_root);

//フレームの余白を設定
const padding_top = 3;
const padding_left = 20;
const padding_bottom = 2;
const padding_right = 20;

// immediateが０ならアニメーションで移動、１なら瞬間的に移動
function set_frame(elem_target, immediate) {
    if (elem_target == null) return;

    //ターゲット要素のサイズと位置を取得
    const offset_top = elem_target.offsetTop;
    const offset_left = elem_target.offsetLeft;
    const offset_width = elem_target.getBoundingClientRect().width;
    const offset_height = elem_target.getBoundingClientRect().height;

    //ターゲット要素のサイズと位置を元にフレームのサイズと位置を決定
    const set_top = offset_top - padding_top;
    const set_left = offset_left - padding_left;
    const set_width = offset_width + padding_left + padding_right;
    const set_height = offset_height + padding_top + padding_bottom;

    if (immediate) {
        gsap.set(elem_root, {
            '--cat-frame-x': set_left + 'px',
            '--cat-frame-y': set_top + 'px',
            '--cat-frame-w': set_width + 'px',
            '--cat-frame-h': set_height + 'px',
        });
    } else {
        gsap.to(elem_root, {
            '--cat-frame-x': set_left + 'px',
            '--cat-frame-y': set_top + 'px',
            '--cat-frame-w': set_width + 'px',
            '--cat-frame-h': set_height + 'px',
            duration: 0.6,
            ease: 'back.inOut(1)',
        });
    }
}

const elems_catItem = document.querySelectorAll('.p-secWorks__catList__item');
if (elems_catItem.length !== 0) {
    elems_catItem.forEach(function (elem_catItem) {
        //カテゴリーを表す要素をクリックするとフレームをそこに移動
        elem_catItem.addEventListener('click', function (event) {
            set_frame(this, 0);
            // リンク先が同一URLの場合barbaが働かずリロードになるので、それを阻止。
            event.preventDefault();
        });

        // この要素内のリンクが、アドレスバーのURLと同じ場合、予めフレームを設定しておく
        const elem_link = elem_catItem.querySelector('a');
        if (elem_link) {
            const href = elem_link.href;
            const url = location.origin + location.pathname;
            if (href === url) {
                elem_catItem.classList.add('js_active_ctg');
            }
        }
    });
}

function whenResizeCatList() {
    const elem_active = document.querySelector('.js_active_ctg');
    if (elem_active) {
        set_frame(elem_active, 1);
    }
}
// カテゴリーリストの要素がリサイズされたらフレームをセットし直す
const elem_catList = document.querySelector('.p-secWorks__catList');
if (elem_catList) {
    const ro = new ResizeObserver(whenResizeCatList);
    ro.observe(elem_catList);
}


//--------------------------------------------------------------------------------------------
//onload
//--------------------------------------------------------------------------------------------
window.addEventListener('load', function () {
    const date = new Date();
    const loadedTime = date.getTime();
    const shortageTime = loadingStart + minLoadingTime - loadedTime;

    //サイト内遷移の場合は直ちにローディング画面を非表示にする
    if (flag_same_site) {
        LoadingToMain();
    } else {
        //最小ローディング時間を経過している場合はローディング画面を非表示にし、スプラッシュアニメーションを表示
        // そうでない場合は残り時間経過後に行う
        if (shortageTime <= 0) {
            LoadingToMain();
            if (flag_do_splash) splashAnim();
        } else {
            setTimeout(function () {
                LoadingToMain();
                if (flag_do_splash) splashAnim();
            }, shortageTime);
        }
    }
});


//--------------------------------------------------------------------------------------------
//ハンバーガーメニュー関係のイベント処理
//--------------------------------------------------------------------------------------------

function menuOpen() {
    const tl = gsap.timeline();
    tl.set('.l-header__humMenu__list', {
        opacity: 0,
        y: '-20%',
    }).call(function () {
        document.querySelector('.l-header__humMenu').classList.add('l-header__humMenu--menuOpen');
    }).to('.l-header__humMenu__list', {
        opacity: 1,
        y: 0,
        duration: 0.2,
    }).to('.l-header__humMenu', {
        backdropFilter: "blur(6px)",
        duration: 0.2,
    }, '<');
}

function menuClose() {
    const tl = gsap.timeline();
    tl.to('.l-header__humMenu__list', {
        opacity: 0,
        y: '-20%',
        duration: 0.2,
    }).to('.l-header__humMenu', {
        backdropFilter: "blur(0px)",
        duration: 0.2,
    }, '<').call(function () {
        document.querySelector('.l-header__humMenu').classList.remove('l-header__humMenu--menuOpen');
    });
}

// オープンボタンのクリック処理
document.querySelector('.l-header__humBtn').addEventListener('click', function () {
    menuOpen();
});

// クローズボタンのクリック処理
document.querySelector('.l-header__humMenu__closeBtn').addEventListener('click', function () {
    menuClose();
});

// ハンバーメニューの各項目をクリックしたらメニューを消す
const elems_gnav_item = document.querySelectorAll('.l-header__humMenu__list__item');
if (elems_gnav_item.length !== 0) {
    elems_gnav_item.forEach(function (elem) {
        elem.addEventListener('click', function () {
            document.querySelector('.l-header__humMenu').classList.remove('l-header__humMenu--menuOpen');
        });
    });
}

// メニュー画面外をクリックしたらメニューを消す
document.querySelector('.l-header__humMenu').addEventListener('click', function () {
    menuClose();
});

// メニュー画面内をクリックした場合はメニューが消えないようにする
document.querySelector('.l-header__humMenu__list').addEventListener('click', function (e) {
    e.stopPropagation();
});
// Use this code in sage
import { gsap } from "gsap";
import Cookies from "js-cookie";

function preloaderPlay() {
    let preloader = document.getElementById('preloader');
    if (!document.body.classList.contains('home')) {
        return;
    }

    if (!preloader) return;

    let jclPreloaderLoaded = Cookies.get('jclPreloaderLoaded') || '';

    if (Number(jclPreloaderLoaded) === 1) {
        preloader.style.display = 'none';
        return;
    };

    const prlLogoWrapper = document.getElementById('prlLogoWrapper');
    const svgBoxContainer = document.getElementById('svgBoxContainer');
    const prlLogoText = document.getElementById('prlLogoText');
    const prlLogoContainer = document.getElementById('prlLogoContainer');
    let prlLogoContainerRect = prlLogoContainer.getBoundingClientRect();
    let prlLogoWrapperRect = prlLogoWrapper.getBoundingClientRect();

    let svgBoxFirstText = document.getElementById('svgBoxFirstText');
    let svgBoxSecondText = document.getElementById('svgBoxSecondText');
    let svgBoxBorder = document.getElementById('svgBoxBorder');
    let svgRectange = document.getElementById('svgRectange');
    let svgBorder = document.getElementById('svgBorder');
    let svgBoxVerticalLine = document.getElementById('svgBoxVerticalLine');
    let svgBoxHorizontalLine = document.getElementById('svgBoxHorizontalLine');
    let svgBoxBorderSize = 301;

    const tl = gsap.timeline();

    tl
        .to(
            prlLogoText,
            {
                clipPath: `inset(0px 100% 0px 0px)`,
                duration: 0.8,
                delay: 1
            }
        )
        .to(
            prlLogoContainer,
            {
                x: `${prlLogoWrapperRect.width / 2 - prlLogoContainerRect.width / 2}px`,
                duration: 1,
            }
        )
        .to(
            svgBoxFirstText,
            {
                opacity: 1,
                duration: 0.5
            }
        )
        .to(
            svgBoxBorder,
            {
                duration: 0.8,
                width: svgBoxBorderSize,
                height: svgBoxBorderSize,
            }
        )
        .to(
            svgBoxSecondText,
            {
                opacity: 1,
            },
            '<'
        )
        .to(
            svgBoxFirstText,
            {
                opacity: 0,
            },
            '<'
        )
        .to(
            svgBoxContainer,
            {
                duration: 1,
                width: ((window.innerWidth + 10) % 2) ? window.innerWidth + 11 : window.innerWidth + 10,
                height: ((window.innerHeight + 10) % 2) ? window.innerHeight + 11 : window.innerHeight + 10
            },
            '<'
        )
        .to(
            svgBoxSecondText,
            {
                delay: 0.2,
                opacity: 0,
            },
        )
        .to(
            svgBoxBorder,
            {
                duration: 1,
                width: window.innerWidth > window.innerHeight ? window.innerWidth : window.innerHeight,
                height: window.innerWidth > window.innerHeight ? window.innerWidth : window.innerHeight,
                onComplete: function () {
                    svgBoxBorder.style.borderColor = 'rgb(0 0 0 / 0%)';
                }
            }
        )
        .to(
            svgBoxContainer,
            {
                delay: 0.5,
                opacity: 0,
                duration: 0.5,
            }
        )
        .to(
            svgBoxContainer,
            {
                opacity: 0,
                duration: 0.5,
            },
            '<'
        )
        .to(
            svgRectange,
            {
                opacity: 0,
                duration: 0.5,
            },
            '<'
        )
        .to(
            preloader,
            {
                opacity: 0,
                duration: 0.5,
                onComplete: function () {
                    preloader.style.display = 'none';
                    Cookies.set('jclPreloaderLoaded', 1, {});
                }
            },
        );
};

preloaderPlay();
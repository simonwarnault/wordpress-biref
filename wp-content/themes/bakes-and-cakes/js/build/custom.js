jQuery(document).ready(function($) {

    var slider_auto, slider_loop, slider_control, rtl, animation;
    
    if (bakes_and_cakes_data.auto == '1') {
        slider_auto = true;
    } else {
        slider_auto = false;
    }

    if (bakes_and_cakes_data.loop == '1') {
        slider_loop = true;
    } else {
        slider_loop = false;
    }

    if (bakes_and_cakes_data.pager == '1') {
        slider_control = true;
    } else {
        slider_control = false;
    }

    if (bakes_and_cakes_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }
    if (bakes_and_cakes_data.animation == 'slide') {
        animation = '';
    } else if (bakes_and_cakes_data.animation == 'fade') {
        animation = 'fadeOut';
    }

    /** Home Page Slider */
    $('#slider').owlCarousel({
        items: 1,
        margin: 0,
        animateOut: animation, //fade, slide//
        autoplaySpeed: bakes_and_cakes_data.a_speed, //ms'
        autoplay: slider_auto,
        loop: slider_loop,
        autoplayTimeout: bakes_and_cakes_data.speed,
        dots: slider_control,
        rtl: rtl,
        mouseDrag: false,
        nav: false,
    });

    $("#site-navigation ul li a").focus(function(){
       $(this).parents("li").addClass("hover");
   }).blur(function(){
       $(this).parents("li").removeClass("hover");
   });

    $('.btn-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $('.map').click(function() {
        $('.map iframe').css("pointer-events", "auto");
    });

    $(".map").mouseleave(function() {
        $('.map iframe').css("pointer-events", "none");
    });


    $("#carousel").owlCarousel({
        margin: 15,
        nav: true,
        dots: false,
        rtl: rtl,
        mouseDrag: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });

    $(".featured-slider").owlCarousel({
        items: 4,
        margin: 0,
        autoplaySpeed: 600, //ms'
        autoplayTimeout: 6000,
        dots: false,
        rtl: rtl,
        mouseDrag: false,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            767: {
                items: 3,
            },
            992: {
                items: 4,
            }
        }

    });

    $(".tabset").owlCarousel({
        items: 5,
        margin: 20,
        autoplaySpeed: 600, //ms'
        autoplayTimeout: 6000,
        rtl: rtl,
        dots: false,
        nav: true,
        responsive: {
            0: {
                items: 3,
            },
            769: {
                items: 5,
            }
        }
    });

    $('.img-btn').click(function(e) {

        id = $(this).attr('id');
        console.log(id);
        $('.img-btn').removeClass('current');
        $(this).addClass('current');

        $.ajax({
            type: 'post',
            url: bakes_and_cakes_data.url,
            data: { 'action': 'bakes_and_cakes_team_ajax', 'id': id },
            beforeSend: function() {
                $('#loader').fadeIn(500);
            },
            success: function(response) {
                $('.our-staff .holder').html(response);
            },
            complete: function() {
                $('#loader').fadeOut(500);
            }
        });


    });

    // Script for back to top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.btn-top').fadeIn();
        } else {
            $('.btn-top').fadeOut();
        }
    });

    $('.btn-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    //mobile-menu
    var winWidth = $(window).width();
    $('.main-navigation ul .menu-item-has-children').append('<span class="angle-down"></span>');


    if (winWidth < 1025) {
        $('.menu-opener').click(function() {
            $('body').addClass('menu-open');
           $('.mobile-menu-wrapper .primary-menu-list').addClass('toggled'); 

            $('.overlay').click(function() {
                $('body').removeClass('menu-open');
           $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
            });

            $('.mobile-menu-wrapper .close-main-nav-toggle').click(function() {
                $('body').removeClass('menu-open');
                $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
            });
        });

    }
    //ul accessibility
    $('<button class="angle-down"></button>').insertAfter($('.main-navigation.mobile-navigation ul .menu-item-has-children > a'));
    $('.main-navigation.mobile-navigation ul li .angle-down').click(function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    $('.menu-opener').click(function() {
        $('body').addClass('menu-open');
       $('.mobile-menu-wrapper .primary-menu-list').addClass('toggled'); 
        $('.mobile-menu-wrapper .close-main-nav-toggle').click(function() {
            $('body').removeClass('menu-open');
            $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
        });
    });

    $(window).on("load, resize", function() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 1025) {
            $('.overlay').click(function() {
                $('body').removeClass('menu-open');
           $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
            });
        }
        else if (viewportWidth> 1025) {
            $('body').removeClass('menu-open');
        }
    });
});

  
// page init
jQuery(function(){
    initTabs();
});

// content tabs init
function initTabs() {
    jQuery('ul.tabset').contentTabs({
        tabLinks: 'a',
        autoRotate: false,
        effect: 'fade', // "fade", "slide"
    });
}

/*
 * jQuery Tabs plugin
 */
;(function($){
    $.fn.contentTabs = function(o){
        // default options
        var options = $.extend({
            activeClass:'active',
            addToParent:false,
            autoHeight:false,
            autoRotate:false,
            checkHash:false,
            animSpeed:400,
            switchTime:10000,
            effect: 'none', // "fade", "slide"
            tabLinks:'a',
            attrib:'href',
            event:'click'
        },o);

        return this.each(function(){
            var tabset = $(this), tabs = $();
            var tabLinks = tabset.find(options.tabLinks);
            var tabLinksParents = tabLinks.parent();
            var prevActiveLink = tabLinks.eq(0), currentTab, animating;
            var tabHolder;

            // handle location hash
            if(options.checkHash && tabLinks.filter('[' + options.attrib + '="' + location.hash + '"]').length) {
                (options.addToParent ? tabLinksParents : tabLinks).removeClass(options.activeClass);
                setTimeout(function() {
                    window.scrollTo(0,0);
                },1);
            }

            // init tabLinks
            tabLinks.each(function(){
                var link = $(this);
                var href = link.attr(options.attrib);
                var parent = link.parent();
                href = href.substr(href.lastIndexOf('#'));

                // get elements
                var tab = $(href);
                tabs = tabs.add(tab);
                link.data('cparent', parent);
                link.data('ctab', tab);

                // find tab holder
                if(!tabHolder && tab.length) {
                    tabHolder = tab.parent();
                }

                // show only active tab
                var classOwner = options.addToParent ? parent : link;
                if(classOwner.hasClass(options.activeClass) || (options.checkHash && location.hash === href)) {
                    classOwner.addClass(options.activeClass);
                    prevActiveLink = link; currentTab = tab;
                    tab.removeClass(tabHiddenClass).width('');
                    contentTabsEffect[options.effect].show({tab:tab, fast:true});
                } else {
                    var tabWidth = tab.width();
                    if(tabWidth) {
                        tab.width(tabWidth);
                    }
                    tab.addClass(tabHiddenClass);
                }

                // event handler
                link.bind(options.event, function(e){
                    if(link != prevActiveLink && !animating) {
                        switchTab(prevActiveLink, link);
                        prevActiveLink = link;
                    }
                });
                if(options.attrib === 'href') {
                    link.bind('click', function(e){
                        e.preventDefault();
                    });
                }
            });

            // tab switch function
            function switchTab(oldLink, newLink) {
                animating = true;
                var oldTab = oldLink.data('ctab');
                var newTab = newLink.data('ctab');
                prevActiveLink = newLink;
                currentTab = newTab;

                // refresh pagination links
                (options.addToParent ? tabLinksParents : tabLinks).removeClass(options.activeClass);
                (options.addToParent ? newLink.data('cparent') : newLink).addClass(options.activeClass);

                // hide old tab
                resizeHolder(oldTab, true);
                contentTabsEffect[options.effect].hide({
                    speed: options.animSpeed,
                    tab:oldTab,
                    complete: function() {
                        // show current tab
                        resizeHolder(newTab.removeClass(tabHiddenClass).width(''));
                        contentTabsEffect[options.effect].show({
                            speed: options.animSpeed,
                            tab:newTab,
                            complete: function() {
                                if(!oldTab.is(newTab)) {
                                    oldTab.width(oldTab.width()).addClass(tabHiddenClass);
                                }
                                animating = false;
                                resizeHolder(newTab, false);
                                autoRotate();
                            }
                        });
                    }
                });
            }

            // holder auto height
            function resizeHolder(block, state) {
                var curBlock = block && block.length ? block : currentTab;
                if(options.autoHeight && curBlock) {
                    tabHolder.stop();
                    if(state === false) {
                        tabHolder.css({height:''});
                    } else {
                        var origStyles = curBlock.attr('style');
                        curBlock.show().css({width:curBlock.width()});
                        var tabHeight = curBlock.outerHeight(true);
                        if(!origStyles) curBlock.removeAttr('style'); else curBlock.attr('style', origStyles);
                        if(state === true) {
                            tabHolder.css({height: tabHeight});
                        } else {
                            tabHolder.animate({height: tabHeight}, {duration: options.animSpeed});
                        }
                    }
                }
            }
            if(options.autoHeight) {
                $(window).bind('resize orientationchange', function(){
                    tabs.not(currentTab).removeClass(tabHiddenClass).show().each(function(){
                        var tab = jQuery(this), tabWidth = tab.css({width:''}).width();
                        if(tabWidth) {
                            tab.width(tabWidth);
                        }
                    }).hide().addClass(tabHiddenClass);

                    resizeHolder(currentTab, false);
                });
            }

            // autorotation handling
            var rotationTimer;
            function nextTab() {
                var activeItem = (options.addToParent ? tabLinksParents : tabLinks).filter('.' + options.activeClass);
                var activeIndex = (options.addToParent ? tabLinksParents : tabLinks).index(activeItem);
                var newLink = tabLinks.eq(activeIndex < tabLinks.length - 1 ? activeIndex + 1 : 0);
                prevActiveLink = tabLinks.eq(activeIndex);
                switchTab(prevActiveLink, newLink);
            }
            function autoRotate() {
                if(options.autoRotate && tabLinks.length > 1) {
                    clearTimeout(rotationTimer);
                    rotationTimer = setTimeout(function() {
                        if(!animating) {
                            nextTab();
                        } else {
                            autoRotate();
                        }
                    }, options.switchTime);
                }
            }
            autoRotate();
        });
    };

    // add stylesheet for tabs on DOMReady
    var tabHiddenClass = 'js-tab-hidden';
    $(function() {
        var tabStyleSheet = $('<style type="text/css">')[0];
        var tabStyleRule = '.'+tabHiddenClass;
        tabStyleRule += '{position:absolute !important;left:-9999px !important;top:-9999px !important;display:block !important}';
        if (tabStyleSheet.styleSheet) {
            tabStyleSheet.styleSheet.cssText = tabStyleRule;
        } else {
            tabStyleSheet.appendChild(document.createTextNode(tabStyleRule));
        }
        $('head').append(tabStyleSheet);
    });

    // tab switch effects
    var contentTabsEffect = {
        none: {
            show: function(o) {
                o.tab.css({display:'block'});
                if(o.complete) o.complete();
            },
            hide: function(o) {
                o.tab.css({display:'none'});
                if(o.complete) o.complete();
            }
        },
        fade: {
            show: function(o) {
                if(o.fast) o.speed = 1;
                o.tab.fadeIn(o.speed);
                if(o.complete) setTimeout(o.complete, o.speed);
            },
            hide: function(o) {
                if(o.fast) o.speed = 1;
                o.tab.fadeOut(o.speed);
                if(o.complete) setTimeout(o.complete, o.speed);
            }
        },
        slide: {
            show: function(o) {
                var tabHeight = o.tab.show().css({width:o.tab.width()}).outerHeight(true);
                var tmpWrap = $('<div class="effect-div">').insertBefore(o.tab).append(o.tab);
                tmpWrap.css({width:'100%', overflow:'hidden', position:'relative'}); o.tab.css({marginTop:-tabHeight,display:'block'});
                if(o.fast) o.speed = 1;
                o.tab.animate({marginTop: 0}, {duration: o.speed, complete: function(){
                    o.tab.css({marginTop: '', width: ''}).insertBefore(tmpWrap);
                    tmpWrap.remove();
                    if(o.complete) o.complete();
                }});
            },
            hide: function(o) {
                var tabHeight = o.tab.show().css({width:o.tab.width()}).outerHeight(true);
                var tmpWrap = $('<div class="effect-div">').insertBefore(o.tab).append(o.tab);
                tmpWrap.css({width:'100%', overflow:'hidden', position:'relative'});

                if(o.fast) o.speed = 1;
                o.tab.animate({marginTop: -tabHeight}, {duration: o.speed, complete: function(){
                    o.tab.css({display:'none', marginTop:'', width:''}).insertBefore(tmpWrap);
                    tmpWrap.remove();
                    if(o.complete) o.complete();
                }});
            }
        }
    };
    var windowWidth = $(window).width();
    if(windowWidth > 1024){
        $("#site-navigation ul li a").focus(function() {
            $(this).parents("li").addClass("focus");
        }).blur(function() {
            $(this).parents("li").removeClass("focus");
        });
    }
}(jQuery));

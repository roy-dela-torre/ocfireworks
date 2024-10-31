<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/functions.js"></script>
<?php $js_path = get_stylesheet_directory_uri() . '/inc/js/' ?>
<script>
    function setEqualHeightForSection(sectionSelector, secondSelector) {
        var elementsToResize = $(sectionSelector).find(secondSelector);
        var tallestHeight = 0;
        elementsToResize.each(function() {
            var height = $(this).height();
            if (height > tallestHeight) {
                tallestHeight = height;
            }
        });
        elementsToResize.css('height', tallestHeight);
    }

    function handleProductColumns(columns) {
        // console.log('asdlsakdjasldkj')
        columns.each(function() {
            $(this).find('.yith-wcwl-add-button img').on('click', function() {
                $('.wishlist_modal_btn').trigger('click');
                updateWishlistModal($(this));
            });
        });
    }

    function updateWishlistModal(button) {
        var contentContainer = button.closest('.product_content');
        var productName = contentContainer.find('h5.text-center').text();
        var productPrice = contentContainer.find('.price').html();
        var productImage = contentContainer.find('.product_image img').attr('src');
        $('.product_added_to_wislist .product img').attr('src', productImage);
        $('.product_added_to_wislist p.product_name').text(productName);
        $('.product_added_to_wislist p.price').html(productPrice);
    }

    function popUpcartUpdate(selfUrl) {
        $.ajax({
            url: selfUrl, // Use the self URL
            method: 'GET', // Make a GET request
            beforeSend: function(xhr) {
                $('#overlay').show()
            },
            success: function(response) {
                $('.cart_button span.cart_count').text($(response).find('span.cart_count').text());
                $('.mini_cart_main_container').html($(response).find('.mini_cart_main_container').html());
                $('#overlay').hide()
                if ($("span.cart_count").text() == 0) {
                    popUpcartUpdate()
                    setTimeout(() => {
                        $('.mini_cart_main_container').show();
                        $('span.close').show();
                    }, 5000);
                }
                setTimeout(() => {
                    $('.mini_cart_main_container').show();
                    $('span.close').show();
                }, 3000);
            },
            error: function(xhr, status, error) {
                // Handle error, e.g., display an error message
                console.error('Error updating cart:', error);
            }
        });
    }

    function replaceThumbnailWithIframe() {
        if (typeof iframeHTML !== 'undefined') {
            $('.modal-body .video_thumbnail').replaceWith(`<iframe width="560" height="315" src="${iframeHTML}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`);
        } else {
            console.error('iframeHTML is not defined');
        }
    }
    $(document).ready(function() {
        var currentUrl = window.location.href;
        $('ul#menu-ocfireworksnavmenu a').each(function() {
            var navUrl = $(this).attr('href');
            if (currentUrl === navUrl) {
                $(this).parent('li').addClass('active');
            }
        });


        $('img[loading="lazy"]').each(function() {
            var $img = $(this);
            var originalSrc = $img.attr('data-src') || $img.attr('src');

            // Ensure originalSrc is set properly
            if (originalSrc) {
                // Use IntersectionObserver for lazy loading
                if ('IntersectionObserver' in window) {
                    var observer = new IntersectionObserver(function(entries, observer) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                var img = entry.target;
                                img.src = img.getAttribute('data-src');
                                observer.unobserve(img);
                            }
                        });
                    });
                    observer.observe(this);
                } else {
                    // Fallback for browsers without IntersectionObserver support
                    $img.attr('src', originalSrc);
                }

                // Set the width and height after the image is loaded
                $img.on('load', function() {
                    var width = $img.width();
                    var height = $img.height();
                    $img.attr({
                        'width': width,
                        'height': height
                    });
                }).attr({
                    'data-src': originalSrc,
                    'decoding': 'async'
                }).one('error', function() {
                    // If there's an error loading the image, revert to original src
                    $(this).attr('src', originalSrc);
                });
            }
        });

        // var priceSpan = $('span.price,p.product.woocommerce.add_to_cart_inline');

        // // Find the dash text node and remove it
        // priceSpan.contents().filter(function() {
        //     return this.nodeType === 3 && this.nodeValue.trim() === '–';
        // }).remove();


        $('.product_column').each(function() {
            $(this).find('.yith-wcwl-add-button img').click(function() {
                console.log('wishlist image click')
                $('.wishlist_modal_btn').trigger('click');
                updateWishlistModal($(this));
            })
        })
        $('span.cart_count').text('<?php echo WC()->cart->get_cart_contents_count(); ?>')
        // image lazy load


        // show hide mini cart on nav
        $('a.add_to_cart_button ').click(function() {
            var selfUrl = window.location.href; // Get the current page URL
            popUpcartUpdate(selfUrl)
        });


        setInterval(() => {
            $('span.close').click(function() {
                $('.mini_cart_main_container').hide()
            });
        }, 1000);

        // sticky nav
        $(window).scroll(function() {
            if ($(this).scrollTop() > 65) {
                $('.sticky-header').addClass('fixed-top');
            } else {
                $('.sticky-header').removeClass('fixed-top');
            }
        });



        // submenu layout
        $('header .main_nav li.menu-item-has-children').each(function() {
            var li_submenue_html = $(this).find('ul.sub-menu').prop('outerHTML')
            var last_child_html = $(this).find('ul.sub-menu li:last-child').prop('outerHTML');
            $(this).find('ul.sub-menu').html(`<div class="main_sub_menu">
                <ul class="child_sub_menu">
                    ${$(this).find('ul.sub-menu').html()}
                </ul>
                <div class="image">
                    ${last_child_html}
                </div>
            </div>`)
        });
        $('ul.child_sub_menu li:last-child').addClass('last-child').remove();

        // search button tabletform.mb-0
        $('form.mb-0 svg').click(function() {
            $('form.mb-0').submit()
        })
        $('header .main_nav li>a').each(function() {
            if ($(this).attr('href') === '#') {
                $(this).attr('href', 'javascript:void(0)');
            }
        });

        $('header li.menu-item-has-children>a').append(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M11.9831 16.5C11.7201 16.4981 11.4603 16.4426 11.2195 16.3369C10.9788 16.2312 10.7622 16.0776 10.5831 15.8854L5.25311 10.1972C5.0796 10.0028 4.98914 9.74835 5.00104 9.48827C5.01294 9.2282 5.12625 8.98306 5.31679 8.80519C5.50733 8.62732 5.76001 8.5308 6.02089 8.53624C6.28177 8.54167 6.53018 8.64864 6.71311 8.8343L11.9831 14.4626L17.2531 8.8343C17.3418 8.73488 17.4496 8.65418 17.57 8.59695C17.6904 8.53972 17.8211 8.50711 17.9544 8.50104C18.0877 8.49497 18.2208 8.51557 18.346 8.56161C18.4711 8.60766 18.5858 8.67823 18.6832 8.76917C18.7806 8.86011 18.8588 8.96957 18.9132 9.09112C18.9676 9.21266 18.997 9.34383 18.9998 9.47691C19.0026 9.60998 18.9786 9.74226 18.9294 9.86597C18.8802 9.98968 18.8066 10.1023 18.7131 10.1972L13.3871 15.8844C13.2076 16.0772 12.9905 16.2313 12.749 16.3372C12.5075 16.4431 12.2469 16.4985 11.9831 16.5Z" fill="#212121"/>
            </svg>`);

        var iframeHTML;

        function replaceThumbnailWithIframe() {
            if (typeof iframeHTML !== 'undefined') {
                $('.modal-body .video_thumbnail').replaceWith(`<iframe width="560" height="315" src="${iframeHTML}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`);
            } else {
                console.error('iframeHTML is not defined');
            }
        }
        $('.product_column .play').click(function() {
            iframeHTML = $(this).closest('.product_column').find('.iframe').html();
            console.log(iframeHTML)
            var title = $(this).closest('.product_column').find('h3.product_title').text();
            $('#video_modal #video_modalLabel').text(title);
            $('.video_modal').click();
        });
        $('img.play_button').click(replaceThumbnailWithIframe);
        $('img.play_button').click(function() {
            $(this).hide()
        })

        $('div#video_modal button.btn.btn-secondary').click(function() {
            $('.modal-body iframe').replaceWith(`<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/video_thumbnail.jpg" alt="" class="video_thumbnail">`);
            $('img.play_button').show()
        })


        var next = $('<img>', {
            src: '<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search/next.png', // Replace with the actual image URL
            alt: 'Next Image' // Add an alt attribute for accessibility
        });
        $('a.next.page-numbers').html(next);
        var prev = $('<img>', {
            src: '<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search/prev.png', // Replace with the actual image URL
            alt: 'Next Image' // Add an alt attribute for accessibility
        });
        $('a.prev.page-numbers').html(prev);

        handleProductColumns($('section.searchResults .row .product_column'));


        // delete duplicated section
        var $sections = $('section');
        var uniqueSections = {};

        $sections.each(function() {
            var id = $(this).attr('class'); // Assuming the ID attribute uniquely identifies each section
            if (!uniqueSections[id]) {
                uniqueSections[id] = true;
            } else {
                $(this).remove(); // Remove the duplicated section
            }
        });

        $('.cart_button a').click(function() {
            $('.mini_cart_main_container').toggle();
        });


    });
</script>
<?php if (is_front_page()) : ?>
    <?php $img = get_stylesheet_directory_uri() . '/assets/img/homepage'; ?>
    <script src="<?php echo $js_path; ?>owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('div#brands').owlCarousel({
                nav: false,
                loop: true,
                margin: 30,
                dots: false,
                autoplay: true,
                autoWidth: true,
                center: true,
                autoplaySpeed: 4200,
                autoplayTimeout: 4200,
                slideTransition: 'linear',
                items: 13,
                mouseDrag: false,
                responsive: {
                    0: {
                        items: 3
                    },
                    576: {
                        items: 4
                    },
                    768: {
                        items: 5
                    },
                    992: {
                        items: 6
                    },
                    1366: {
                        items: 7
                    },
                    1440: {
                        items: 8
                    },
                    1920: {
                        items: 10
                    }
                }
            });

            $('#about_us').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                autoplay: true,
                autoplaySpeed: 30000,
                autoplayTimeout: 30000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })


            handleProductColumns($('section.featured_product .row .product_column'));
            handleProductColumns($('section.special_product .row .product_column'));


            // banner hover function change banner to gif
            $(document).on('click scroll', function(e) {
                $('section.banner').addClass('hover');
                $('section.banner').css('background', 'url("<?php echo get_stylesheet_directory_uri(); ?>/assets/img/homepage/banner.gif") no-repeat bottom center/cover');
            });
        })
    </script>
<?php elseif (is_page('about-us')) : ?>
    <script src="<?php echo $js_path; ?>owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('div#brands').owlCarousel({
                nav: false,
                loop: true,
                margin: 30,
                dots: false,
                autoplay: true,
                autoWidth: true,
                center: true,
                autoplaySpeed: 4200,
                autoplayTimeout: 4200,
                slideTransition: 'linear',
                items: 13,
                mouseDrag: false,
                responsive: {
                    0: {
                        items: 3
                    },
                    576: {
                        items: 4
                    },
                    768: {
                        items: 5
                    },
                    992: {
                        items: 6
                    },
                    1366: {
                        items: 7
                    },
                    1440: {
                        items: 8
                    },
                    1920: {
                        items: 10
                    }
                }
            });
            $('.maps img').hover(function() {
                $(this).replaceWith(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.830235591817!2d-86.12994982392547!3d41.68100967126406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced2f51055%3A0x31b6dc1f1e028037!2sOCFireworks.com!5e0!3m2!1sen!2sph!4v1715232345741!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`);
            })
        });
    </script>
<?php elseif (is_page('curbside-pickup')) : ?>
    <script>
        $(document).ready(function() {
            $('.maps img,.content img.maps').hover(function() {
                $(this).replaceWith(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.830235591817!2d-86.12994982392547!3d41.68100967126406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced2f51055%3A0x31b6dc1f1e028037!2sOCFireworks.com!5e0!3m2!1sen!2sph!4v1715232345741!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`);
            })
        });
    </script>
<?php elseif (is_cart()) : ?>
    <script>
        $(document).ready(function() {

        })
    </script>
<?php elseif (is_archive()) : ?>
    <script>
        $(document).ready(function() {
            $('#min-price, #max-price').on('input change', function() {
                setTimeout(() => {
                    var next = $('<img>', {
                        src: '<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search/next.png', // Replace with the actual image URL
                        alt: 'Next Image' // Add an alt attribute for accessibility
                    });
                    $('a.next.page-numbers').html(next);
                    var prev = $('<img>', {
                        src: '<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search/prev.png', // Replace with the actual image URL
                        alt: 'Next Image' // Add an alt attribute for accessibility
                    });
                    $('a.prev.page-numbers').html(prev);
                }, 2000);
            });

            function checkWindowWidth() {
                if ($(window).width() <= 991) {
                    $('.sidebar_filter.sticky-top').remove();
                }
            }

            // Check window width on page load
            checkWindowWidth();

            // Check window width on window resize
            $(window).resize(function() {
                checkWindowWidth();
            });
        });
    </script>
<?php elseif (is_page('contact-us')) : ?>
    <script>
        $(document).ready(function() {
            $('.map img').click(function() {
                $(this).replaceWith(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.81454097319!2d-86.12738829999999!3d41.6813486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced1933acd%3A0xdf1e5c9119ca9b1e!2s13421%20McKinley%20Hwy%2C%20Mishawaka%2C%20IN%2046545%2C%20USA!5e0!3m2!1sen!2sph!4v1713774385763!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`)
            })
        })
    </script>

<?php elseif (is_page('shipping-info')) : ?>
    <script>
        $(document).ready(function() {
            $('section.video img').click(function() {
                $(this).replaceWith(`<iframe width="960" height="315" src="https://www.youtube.com/embed/8Ziw73eZBl4" title="OCF SHIPPING VIDEO" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> `)
            })
        })
    </script>

<?php elseif (is_single()) : ?>
    <script>
        $(document).ready(function() {
            const comments = $('ol.commentlist li');
            const maxVisibleComments = 3;
            comments.each(function(index) {
                if (index >= maxVisibleComments) {
                    $(this).hide();
                }
            });
            if (comments.length == 0) {
                $('.load_more').hide()
            }
            $('.load_more').click(function() {
                var hiddenComments = $('ol.commentlist li[style*="display: none;"]');
                if (hiddenComments.length > 0) {
                    $(hiddenComments[0]).slideDown().removeAttr('style');
                }
                if (hiddenComments.length <= 1) {
                    $('.load_more').hide();
                }
            });

            $('section.product_reviews .iframe img.play_button').click(function() {
                $(this).hide();
                $('section.product_reviews .iframe img.video_thumbnail').hide();
                $('section.product_reviews .iframe iframe').removeClass('d-none')
            })
        });
    </script>
<?php elseif (is_page(221) || is_page('recently-viewed')) : ?>
    <?php $img = get_stylesheet_directory_uri() . '/assets/img/homepage'; ?>
    <script>
        $(document).ready(function() {
            handleProductColumns($('section.my_account .row .product_column'));

            var iframeHTML;

            function replaceThumbnailWithIframe() {
                console.log('click')
                if (typeof iframeHTML !== 'undefined') {
                    $('.modal-body .video_thumbnail').replaceWith(`<iframe width="560" height="315" src="${iframeHTML}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`);
                } else {
                    console.error('iframeHTML is not defined');
                }
            }
            $('section.my_account .product_column .play').click(function() {
                console.log('click')
                iframeHTML = $(this).closest('.product_column').find('.iframe').html();
                console.log(iframeHTML)
                var title = $(this).closest('.product_column').find('h3.product_title').text();
                $('#video_modal #video_modalLabel').text(title);
                $('.video_modal').click();
            });
            $('img.play_button').click(replaceThumbnailWithIframe);
            $('img.play_button').click(function() {
                $(this).hide()
                console.log('click')
            })

            $('div#video_modal button.btn.btn-secondary').click(function() {
                $('.modal-body iframe').replaceWith(`<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/video_thumbnail.jpg" alt="" class="video_thumbnail">`);
                $('img.play_button').show()
            })
        });
    </script>
<?php elseif (is_page('4th-of-july-fireworks-for-sale') || is_page(257)) : ?>
    <script>
        $(document).ready(function() {
            setEqualHeightForSection('section.best_fire_word', 'h3')
            setEqualHeightForSection('section.how_to_plan_you_4th_of_july', 'h3')
            setEqualHeightForSection('section.how_to_use_4th_of_july', 'h3')
        });
    </script>

<?php elseif (is_page('After you order') || is_page(239)) : ?>
    <script>
        $(document).ready(function() {
            $('section.banner .video img,section.banner .content img').click(function() {
                $(this).replaceWith(`<iframe width="560" height="315" src="https://www.youtube.com/embed/8Ziw73eZBl4?si=LrYGT--kw-wd7UQH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`)
            })
        })
    </script>

<?php elseif (is_page('Product Demos')) : ?>
    <script>
        $(document).ready(function() {
            $('section.product_demos .content2020 img').click(function() {
                $(this).replaceWith(`<iframe width="560" height="315" src="https://www.youtube.com/embed/U63bT6HuvKk?si=yD0XMxXNLCyLlHlh" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`)
            })
            $('section.product_demos .content2019 img').click(function() {
                $(this).replaceWith(`<iframe width="560" height="315" src="https://www.youtube.com/embed/i0px8Or4d_M?si=WK6QdbgHQv8BYca2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`)
            })
        })
    </script>
<?php endif; ?>
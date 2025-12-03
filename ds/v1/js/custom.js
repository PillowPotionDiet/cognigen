$(document).on('ready', function() {
      $(".full-width").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true,
        autoplay:true,
        autoplaySpeed:3000,
        slidesToShow: 1,
        slidesToScroll: 1

      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1

      });
    });
    $(document).ready(function() {
        $(".set > a").on("click", function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass("active");
                $(this).siblings('.content').slideUp(200);
                $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
            } else {
                $(".set > a i").removeClass("fa-minus").addClass("fa-plus");
                $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
                $(".set > a").removeClass("active");
                $(this).addClass("active");
                $('.content').slideUp(200);
                $(this).siblings('.content').slideDown(200);
            }
        });
    });

    $(function() {

        function toggleChevron(e) {
            $(e.target)
                    .prev('.panel-heading')
                    .find("i")
                    .toggleClass('rotate-icon');
            $('.panel-body.animated').toggleClass('zoomIn zoomOut');
        }
        
        $('#accordion').on('hide.bs.collapse', toggleChevron);
        $('#accordion').on('show.bs.collapse', toggleChevron);
    })
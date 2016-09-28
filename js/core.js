   $(document).ready(function () {
                $("#overlay").hide();

                $(function () {
                    $('.content_box').click(function () {
                        $('#overlay').fadeIn('fast', function () {
                            $('body').css('overflow', 'hidden');
                            $('#modalBox').animate({'top': '10%'}, 500).show();
                        });

                    });

                    $('.closeModal').click(function () {
                        $('body').css('overflow', 'scroll');
                        $('#modalBox').animate({'top': '-500%'}, 500, function () {
                            $('#overlay').hide();
                        });
                    });
                });

                $(".content_box").click(function () {
                    $(".modalChecker").empty();
                    $(".modalChecker").append($(this).html());
                });
            });
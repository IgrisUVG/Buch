$('a').tooltip({
    track: true,
    show: {
        effect: "slideDown",
        delay: 800
    },
    hide: {
        effect: "fade",
        delay: 50
    }//,
//        content: function () {
//            var element = $(this);
//            if (element.className == <?php //echo $autor_id ?>//) {
//                var imaga = '<?php
    //                    $img = 'SELECT cover FROM autors WHERE autor_id';
    //                    return $img;
    //                    ?>//';
//                return '<img src="scripts/showImage.php?image_id=' + imaga + '>"';
//            }
//        }
});
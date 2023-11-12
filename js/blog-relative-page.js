(function($){
	//Move post date inside post title to under post title
    $('.post-title').each((i, e) => {
       $(e).after($(e).find('.post-date')); 
    });
	$('.recent-blog-posts > div > a').each((id, ele) => {
		$(ele).after($(ele).find('.post-date'));
	});
	//Remove post date div inside title attribute
	$('.recent-blog-posts > div > a').attr('title', (id, value) => {
		return value.split('<div cl')[0];
	});
	
	// Change taxonomy description content container class
    $('.taxonomy-description .desc-content .read-more-btn').on("click", function() {
        let $content = $('.taxonomy-description .desc-content');
        if($content.hasClass('collapsed')) $(this).text("Ẩn bớt");
        else $(this).text("Xem thêm");
        $content.toggleClass('collapsed');
        $content.toggleClass('expanded');
    });
})(jQuery);
// Change post title position when change window size
function changePostTitlePosition(){
	if(window.innerWidth < 550) {
		document.querySelectorAll('.post-item .box').forEach(box => {
			if(box.querySelector('.box-text').contains(box.querySelector('.post-title'))){
			   box.insertBefore(box.querySelector('.post-title'), box.querySelector('.box-image')); 
			}
		});
	} else {
		document.querySelectorAll('.post-item .box').forEach(box => {
			if(!box.querySelector('.box-text').contains(box.querySelector('.post-title'))){
			   box.querySelector('.box-text-inner').insertBefore(box.querySelector('.post-title'), box.querySelector('.post-date')); 
			}
		});
	}
}
changePostTitlePosition();
window.addEventListener("resize", changePostTitlePosition);
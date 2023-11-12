const handleResizeOfBanner = () => {
	let currentWindowSize = window.innerWidth;
	const bannerOfOtherPages = document.querySelector('.header-banner-all-other-pages');
	const welcomeSectionSecondColumn = document.querySelector('.welcome-section .row > .col:last-child > .col-inner');
	
	if(currentWindowSize > 1280) {
		bannerOfOtherPages.querySelector('.col:first-of-type > .col-inner').style.paddingLeft=`${(currentWindowSize - 1280) / 20}rem`;
		if(welcomeSectionSecondColumn != null) welcomeSectionSecondColumn.style.paddingRight=`${(currentWindowSize - 1280) / 20}rem`;
	}
	else {
		bannerOfOtherPages.querySelector('.col:first-of-type > .col-inner').style.paddingLeft=`0`;
		if(welcomeSectionSecondColumn != null) welcomeSectionSecondColumn.style.paddingRight='0';
	}
}
handleResizeOfBanner();
window.addEventListener("resize", handleResizeOfBanner);
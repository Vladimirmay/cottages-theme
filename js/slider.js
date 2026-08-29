// Слайдер растягивается на всю ширину .page-wrap в обе стороны:
// соседние карточки не обрезаются искусственной границей внутри вёрстки,
// а уходят за левый и правый край страницы (на широких мониторах — до края
// ограниченной по max-width обёртки, а не до истинного края окна).
// slidesOffsetBefore держит первую карточку на исходном месте
// (вровень с заголовком секции).
function initEdgeToEdgeSlider(el, swiperOptions) {
  if (!el) return;

  let swiper;
  const pageWrap = document.querySelector(".page-wrap");

  function fitViewportEdges() {
    el.style.marginLeft = ""; // сброс перед замером текущей позиции слева
    el.style.width = "";

    const wrapRect = pageWrap
      ? pageWrap.getBoundingClientRect()
      : { left: 0, right: window.innerWidth };
    const offsetLeft = el.getBoundingClientRect().left - wrapRect.left;
    const trackWidth = wrapRect.right - wrapRect.left;

    el.style.marginLeft = -offsetLeft + "px";
    el.style.width = trackWidth + "px";

    if (swiper) {
      swiper.params.slidesOffsetBefore = offsetLeft;
      swiper.update();
    }

    return offsetLeft;
  }

  const initialOffset = fitViewportEdges();

  swiper = new Swiper(el, {
    ...swiperOptions,
    slidesOffsetBefore: initialOffset,
  });

  window.addEventListener("resize", fitViewportEdges);

  return swiper;
}

document.addEventListener("DOMContentLoaded", function () {
  initEdgeToEdgeSlider(document.querySelector(".objects__slider"), {
    slidesPerView: "auto",
    spaceBetween: 16,
    navigation: {
      nextEl: ".objects__arrow--next",
      prevEl: ".objects__arrow--prev",
    },
  });

  initEdgeToEdgeSlider(document.querySelector(".reasons__slider"), {
    slidesPerView: "auto",
    spaceBetween: 16,
    grabCursor: true,
  });
});

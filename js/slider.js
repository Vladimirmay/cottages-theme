// Слайдер растягивается на всю ширину окна браузера в обе стороны:
// соседние карточки не обрезаются искусственной границей внутри вёрстки,
// а уходят за левый и правый край экрана. slidesOffsetBefore держит
// первую карточку на исходном месте (вровень с заголовком секции).
function initEdgeToEdgeSlider(el, swiperOptions) {
  if (!el) return;

  let swiper;

  function fitViewportEdges() {
    el.style.marginLeft = ""; // сброс перед замером текущей позиции слева
    el.style.width = "";

    const offsetLeft = el.getBoundingClientRect().left;

    el.style.marginLeft = -offsetLeft + "px";
    el.style.width = window.innerWidth + "px";

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
    slidesPerView: "auto", // ширина слайда задаётся в CSS (416px / 313px), Swiper сам считает, сколько влезает
    spaceBetween: 16,
    navigation: {
      nextEl: ".objects__arrow--next",
      prevEl: ".objects__arrow--prev",
    },
  });

  // Слайдер без стрелок навигации — активен только на планшете/мобилке (см. CSS)
  initEdgeToEdgeSlider(document.querySelector(".reasons__slider"), {
    slidesPerView: "auto",
    spaceBetween: 16,
    grabCursor: true,
  });
});

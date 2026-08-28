document.addEventListener("DOMContentLoaded", function () {
  const objectsSlider = document.querySelector(".objects__slider");
  if (!objectsSlider) return;

  let swiper;

  // Слайдер растягивается на всю ширину окна браузера в обе стороны:
  // соседние карточки не обрезаются искусственной границей внутри вёрстки,
  // а уходят за левый и правый край экрана. slidesOffsetBefore держит
  // первую карточку на исходном месте (вровень с заголовком секции).
  function fitViewportEdges() {
    objectsSlider.style.marginLeft = ""; // сброс перед замером текущей позиции слева
    objectsSlider.style.width = "";

    const offsetLeft = objectsSlider.getBoundingClientRect().left;

    objectsSlider.style.marginLeft = -offsetLeft + "px";
    objectsSlider.style.width = window.innerWidth + "px";

    if (swiper) {
      swiper.params.slidesOffsetBefore = offsetLeft;
      swiper.update();
    }

    return offsetLeft;
  }

  const initialOffset = fitViewportEdges();

  swiper = new Swiper(objectsSlider, {
    slidesPerView: "auto", // ширина слайда задаётся в CSS (416px / 313px), Swiper сам считает, сколько влезает
    spaceBetween: 16,
    slidesOffsetBefore: initialOffset,
    navigation: {
      nextEl: ".objects__arrow--next",
      prevEl: ".objects__arrow--prev",
    },
  });

  window.addEventListener("resize", fitViewportEdges);
});

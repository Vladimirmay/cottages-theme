document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contactForm");
  if (!form) return;

  const nameInput = document.getElementById("field-name");
  const phoneInput = document.getElementById("field-phone");
  const consentInput = document.getElementById("field-consent");

  // --- Маска телефона (сохраняем экземпляр, чтобы проверять заполненность) ---
  const phoneMask = IMask(phoneInput, {
    mask: "+7 (000) 000-00-00",
  });

  // --- Хелперы для покраснения поля ---
  function setInvalid(input) {
    input.classList.add("contact-form__input--invalid");
  }
  function clearInvalid(input) {
    input.classList.remove("contact-form__input--invalid");
  }

  // Снимаем красноту, как только пользователь начинает исправлять поле
  nameInput.addEventListener("input", function () {
    clearInvalid(nameInput);
  });
  phoneInput.addEventListener("input", function () {
    clearInvalid(phoneInput);
  });

  // --- Проверка отдельных полей ---
  function validateName() {
    // Имя: не пустое, минимум 2 символа без учёта пробелов
    if (nameInput.value.trim().length < 2) {
      setInvalid(nameInput);
      return false;
    }
    clearInvalid(nameInput);
    return true;
  }

  function validatePhone() {
    // Телефон: маска заполнена полностью (masked.complete)
    if (!phoneMask.masked.isComplete) {
      setInvalid(phoneInput);
      return false;
    }
    clearInvalid(phoneInput);
    return true;
  }

  // --- Перехват отправки формы ---
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const isNameValid = validateName();
    const isPhoneValid = validatePhone();
    const isConsentValid = consentInput.checked;

    if (!(isNameValid && isPhoneValid && isConsentValid)) {
      return; // есть невалидные поля — не отправляем
    }

    // Собираем данные формы
    const formData = new FormData();
    formData.append("action", "cottages_application"); // имя нашего обработчика
    formData.append(
      "cottages_application_nonce",
      form.querySelector("#cottages_application_nonce")
        ? form.querySelector("#cottages_application_nonce").value
        : form.querySelector('[name="cottages_application_nonce"]').value,
    );
    formData.append("name", nameInput.value.trim());
    formData.append("phone", phoneInput.value);
    formData.append(
      "contact_method",
      form.querySelector('[name="contact_method"]:checked')
        ? form.querySelector('[name="contact_method"]:checked').value
        : "",
    );
    formData.append("consent", consentInput.checked ? "1" : "");

    const statusEl = document.getElementById("formStatus");
    const submitBtn = form.querySelector(".contact-form__submit");

    // Блокируем кнопку на время отправки
    submitBtn.disabled = true;
    statusEl.className = "contact-form__status";
    statusEl.textContent = "Отправляем...";

    // Отправляем на сервер
    fetch(cottagesAjax.url, {
      method: "POST",
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (result) {
        if (result.success) {
          statusEl.className = "contact-form__status is-success";
          statusEl.textContent = result.data.message;
          form.reset(); // очищаем форму
          phoneMask.value = ""; // сбрасываем маску телефона
        } else {
          statusEl.className = "contact-form__status is-error";
          statusEl.textContent =
            result.data.message || "Произошла ошибка. Попробуйте позже.";
        }
      })
      .catch(function () {
        statusEl.className = "contact-form__status is-error";
        statusEl.textContent = "Ошибка соединения. Попробуйте позже.";
      })
      .then(function () {
        submitBtn.disabled = false; // разблокируем кнопку в любом случае
      });
  });
});

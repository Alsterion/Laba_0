document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector("body"),
        sidebar = body ? body.querySelector(".Sidebar") : null,
        toggle = body ? body.querySelector(".toggle") : null,
        modeSwitch = body ? body.querySelector(".toggle-switch") : null,
        modeText = body ? body.querySelector(".mode-text") : null;

    if (!body || !sidebar || !toggle || !modeSwitch || !modeText) {
        console.error("Не удалось найти один или несколько элементов.");
        return;
    }

    // Проверяем, есть ли сохраненное состояние темы в Local Storage
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        body.classList.add("dark");
        modeText.innerText = "Light Mode";
    }

    // Раскрытие|Закрытие бокового меню
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    // Переключатель темы
    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light Mode";
            // Сохраняем состояние темы в Local Storage
            localStorage.setItem("theme", "dark");
        } else {
            modeText.innerText = "Dark Mode";
            // Удаляем сохраненное состояние темы из Local Storage
            localStorage.removeItem("theme");
        }
    });
});

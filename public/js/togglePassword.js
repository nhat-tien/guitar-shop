function togglePassword(query, className, input) {
    document.querySelector(query).classList.toggle(className);
    const inputEl = document.querySelector(input);
    if(inputEl.getAttribute("type") == "password") {
        inputEl.setAttribute("type", "text");
    } else {
        inputEl.setAttribute("type", "password");
    }
}
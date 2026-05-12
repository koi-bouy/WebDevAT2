function validate(e) {
    const input = e.target;
    const text = input.value = input.value.trim();
    const injection = /<\s*(?:\/\s*)?script\s*?(?:\s[^>]*)?>/i;

    if (text === "") {
        input.setCustomValidity("Please fill out this field.");
    } else if (injection.test(text)) {
        input.setCustomValidity("Oi! No <script> tags!");
    }
    else {
        input.setCustomValidity("");
    }

    input.reportValidity();

}

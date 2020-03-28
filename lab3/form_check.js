const formValidator = {
    validate: function(form) {
        return [
            ['f_miasto', 'Podaj miasto!', this.validateNotEmptyOrWhitespace.bind(this)],
            ['f_ulica', 'Podaj ulicę!', this.validateNotEmptyOrWhitespace.bind(this)],
            ['f_kod', 'Podaj kod!', this.validateNotEmptyOrWhitespace.bind(this)],
            ['f_email', 'Podaj email!', this.validateEmail.bind(this)],
            ['f_nazwisko', 'Podaj nazwisko!', this.validateNotEmptyOrWhitespace.bind(this)],
            ['f_imie', 'Podaj imię!', this.validateNotEmptyOrWhitespace.bind(this)],
        ].reduce((prev, [name, msg, validator]) => {
            return this.checkStringAndFocus(form.elements[name], msg, validator) && prev;
        }, true);
    },

    checkStringAndFocus: function(obj, msg, validator) {
        const str = obj.value;
        const errorFieldId = "#e_" + obj.name.substr(2);
        const errorFieldNode = document.querySelector(errorFieldId);
        if (!validator(str)) {
            errorFieldNode.innerHTML = msg;
            obj.focus();

            return false;
        }
        errorFieldNode.innerHTML = '';

        return true;
    },

    validateNotEmptyOrWhitespace: function(text) {
        return !/^[\s\t\r\n]*$/.test(text);
    },

    validateEmail: function(email) {
        return /^[a-zA-Z_0-9\.]+@[a-zA-Z_0-9\.]+\.[a-zA-Z]{2,}$/.test(email);
    },
};

function nextNode(e) {
    while (e && e.nodeType != 1) {
        e = e.nextSibling;
    }
    return e;
}
function prevNode(e) {
    while (e && e.nodeType != 1) {
        e = e.previousSibling;
    }
    return e;
}

function swapRows(b) {
    let tab = prevNode(b.previousSibling);
    let tBody = nextNode(tab.firstChild);
    let lastNode = prevNode(tBody.lastChild);
    tBody.removeChild(lastNode);
    let firstNode = nextNode(tBody.firstChild);
    tBody.insertBefore(lastNode, firstNode);
}

function cnt(form, msg, maxSize) {
    if (form.value.length > maxSize) form.value = form.value.substring(0, maxSize);
    else msg.innerHTML = maxSize - form.value.length;
}

(function alterRows(i, e) {
    if (e) {
        if (i % 2 == 1) {
            e.setAttribute("style", "background-color: Aqua;");
        }
        e = e.nextSibling;
        while (e && e.nodeType != 1) {
            e = e.nextSibling;
        }
        alterRows(++i, e);
    }
})(1, document.querySelector('body > table:first-child tbody > tr:first-child'));

document.querySelectorAll('input[name="f_plec"]').forEach((radio) => {
    console.log(radio)
    radio.onclick = () => {
        document.querySelector('#f_nazwisko_p_wrapper').style.visibility = 
            (radio.value === 'f_k') ? 'visible' : 'hidden';
    };
});
document.querySelector('#f_nazwisko_p_wrapper').style.visibility = 
            (document.querySelector('input[value="f_k"]').checked) ? 'visible' : 'hidden';
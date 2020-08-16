
//switch to white mode
function whiteMode() {
    let cont = document.getElementById('container')
    cont.classList.remove('dark')
    document.body.style.background = "#fff"
}


//switch to dark mode
function darkMode() {
    let cont = document.getElementById('container')
    cont.classList.add('dark')
    document.body.style.background = "#141414"
}

// Click on blank field
jQuery(document).ready(function () {
    jQuery('.unknown').click(function () {
        clearSelected()
        clearEdited()
        $(this).addClass('selected')
    })
})


// Clear selected field
function clearSelected() {
    let sel = $('.selected')
    if (sel.length > 0) {
        sel.removeClass('selected')
    }
}

// Clear edited field
function clearEdited() {
    $('.edited').removeClass('edited')

}


// Edit selected value
function editValue() {
    let error = $('#error').html()
    Number(error) < 3 ? $('.selected').addClass('edited') : null
}


// Errors counter
function showErrors() {
    return 10;
}

// Timer 
var times;

function startTimer() {
    console.log(stopTime)
    var minutesLabel = document.getElementById("minutes");
    var secondsLabel = document.getElementById("seconds");
    var totalSeconds = 0;
    times = setInterval(setTime, 1000);



    function setTime() {
        ++totalSeconds;
        secondsLabel.innerHTML = pad(totalSeconds % 60);
        minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
    }

    function pad(val) {
        var valString = val + "";
        if (valString.length < 2) {
            return "0" + valString;
        } else {
            return valString;
        }
    }
}

function stopTime() {
    clearInterval(times)

}

// Validate emial by rule
function validateEmail(email) {
    var re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Email validation while input symbols
$(document).ready(function () {
    $('input[name=email]').keyup(function (value) {
        validateEmail(value.target.value) ? $('.erroremail').html('') : $('.erroremail').html('Nesprávny e-mail!')
    })
})

// Validate password length
$(document).ready(function () {
    $('input[name=password]').keyup(function (value) {
        if (value.target.value.length < 4) {
            $('.errorpassword').html('Heslo je kratšie ako 4 znaky!')
        } else if (value.target.value.length > 10) {
            $('.errorpassword').html('Heslo je dlhšie ako 10 znakov!')
        } else {
            $('.errorpassword').html('')
        }

    })
})

// Validate password
function validatePassword(value) {
    if (value.length > 3 && value.length < 11) {
        return true
    } else {
        return false
    }
}



// Register new user
$(document).ready(function () {
    $('#register_form').submit(function (value) {
        value.preventDefault();
        const email = $('input[name=email]').val()
        const password = $('input[name=password]').val()

        if (validateEmail(email) && validatePassword(password)) {
            $.post(
                'Auth/register.php', {
                email,
                password,
            },
                function (data) {
                    $('#reg_result').html(data)

                }
            )
        }


    })
})

// Sign in for user
$(document).ready(function () {
    $('#login_form').submit(function (value) {
        value.preventDefault();
        const email = $('#login_email').val()
        const password = $('#login_pass').val()
        if (validateEmail(email) && validatePassword(password)) {

            $.post(
                'Auth/auth.php', {
                email,
                password,
            },
                function (data) {
                    if (data === 'success') {
                        window.location.href = 'profile/'
                    } else {
                        $('#log_result').html(data)

                    }

                }
            )
        }

    })
})

// check if it end of game
function isEndGame() {
    let out = []
    let counter = 0
    let items = document.querySelectorAll('.row')
    let keys = Object.keys(items)
    for (let i = 0; i < keys.length; i++) {
        for (let j = 0; j < 16; j++) {
            
            if (items[keys[i]].children[j].innerHTML.length === 0) {counter++;  }// count blank cells
            if (counter > 1) return false // if blank cells more than 2 then nothing to check yet
            else
              out.push(items[keys[i]].children[j].innerHTML)  // overwise saving all values into array and check
        }
    }
    return out
}


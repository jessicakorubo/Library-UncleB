const return_buttons = document.querySelectorAll('.return-button');
const return_popups = document.querySelectorAll('.popup-return');

let popupOpen = false;

function openPopup(popup) {
    popup.classList.add('active');
    popupOpen = true;
}

// Function to close all popups
function closePopup() {
    return_popups.forEach(popup => {
        popup.classList.remove('active');
        popupOpen = false;
    })
}

return_buttons.forEach(return_button => {
    return_button.addEventListener('click', (e) => {
        e.preventDefault(); //Prevent default behaviour of links or form submission


        const popup = return_button.nextElementSibling;

        if (popupOpen) {
            return;
        }
        openPopup(popup);

    })
});

return_popups.forEach(popup => {
    const close_button = popup.querySelector('.close');
    if (close_button) {
        close_button.addEventListener('click', (e) => {
            e.preventDefault();
            closePopup(popup);
        });
    }
})

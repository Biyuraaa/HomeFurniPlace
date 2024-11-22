// cart container 
const cartButton = document.getElementById('cart-button');
const cartContainer = document.getElementById('cart-container');
const bodyContainer = document.querySelector('body');

let toggle  = 0;
cartButton.addEventListener('click', ()=> {
    if(toggle === 0)
    {
        cartContainer.style.visibility = 'visible';
        cartContainer.style.opacity = '1';
        cartContainer.style.height = '300px';
        cartButton.style.color = 'black';
        toggle = 1;
    }
    else 
    {
        cartContainer.style.visibility = 'hidden';
        cartContainer.style.opacity = '0';
        cartContainer.style.height = '0px';
        cartButton.style.color = 'gray';
        toggle = 0;
    }
});

//navigation 
const roomButtonContainer = document.getElementById('nav-room-container-desc')
const roomButton = document.getElementById('room-button');

let roomButtonToggle = 0;
roomButton.addEventListener('click', ()=> {
    console.log('room nav clicked')
    if(roomButtonToggle === 0)
    {
        roomButtonContainer.style.visibility = 'visible';
        roomButtonContainer.style.opacity = '1';
        roomButtonContainer.style.height = '300px'
        roomButton.style.color = 'black';
        roomButtonToggle = 1;
    }
    else 
    {
        roomButtonContainer.style.visibility = 'hidden';
        roomButtonContainer.style.opacity = '0';
        roomButtonContainer.style.height = '100px'
        roomButton.style.color = 'gray';
        roomButtonToggle = 0;
    }
});

// product container 

const productButtonContainer = document.getElementById('nav-product-container-description')
const productButton = document.getElementById('product-button');

let productButtonToggle = 0;
productButton.addEventListener('click', ()=> {
    console.log('room nav clicked')
    if(productButtonToggle === 0)
    {
        productButtonContainer.style.visibility = 'visible';
        productButtonContainer.style.opacity = '1';
        productButtonContainer.style.height = '300px'
        productButton.style.color = 'black';
        productButtonToggle = 1;
    }
    else 
    {
        productButtonContainer.style.visibility = 'hidden';
        productButtonContainer.style.opacity = '0';
        productButtonContainer.style.height = '100px'
        productButton.style.color = 'gray';
        productButtonToggle = 0;
    }
});

AOS.init();


//loader 

window.addEventListener('load', ()=> {
    const loader = document.querySelector('.loader-wrapper');
    loader.style.display = 'none';
})

// filter button 
const filterButton = document.getElementById('filter-button');
const filterCloseButton = document.getElementById('filter-close-button');
const filterContainer = document.querySelector('.filter-container');
const filterContainerDescription = document.querySelector('.filter-container .filter-description')

filterButton.addEventListener('click', ()=> {
    filterContainer.style.display = "flex";
    filterContainerDescription.style.animation = "rightinside";
    filterContainerDescription.style.animationDuration = "500ms";
})
filterCloseButton.addEventListener('click', ()=> {
    filterContainerDescription.style.animation = "rightoutside";
    filterContainerDescription.style.animationDuration = "500ms";
    filterContainer.style.display = "none";
})

//Accordion

const accordionButton = document.getElementsByClassName('accordion');

for(let i=0;i<accordionButton.length;i++)
{
    accordionButton[i].addEventListener('click', ()=> {
        accordionButton[i].classList.toggle('active');
        let panelElement = accordionButton[i].nextElementSibling;
        if(panelElement.style.maxHeight)
        {
            panelElement.style.maxHeight = null;
        }
        else 
        {
            panelElement.style.maxHeight = panelElement.scrollHeight + "px";
        }
    });
}


//filter input 

const panelPriceInput = document.getElementById('panel-price-input');
const priceDisplay = document.getElementById('price-display');

panelPriceInput.oninput = function()
{
    priceDisplay.textContent = `Current Price: $ ${panelPriceInput.value}`;
}

const filterContent = document.querySelectorAll('#filter-content');

filterContent.forEach(button => {
    let isBlack = false;
    button.addEventListener('click', ()=> {
        if(isBlack === false)
        {
            button.style.color = "black";
            isBlack = true;
        }
        else
        {
            button.style.color = "gray";
            isBlack = false;
        }
    })
})



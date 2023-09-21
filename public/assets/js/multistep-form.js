// multistep form
const formStep = document.querySelectorAll('.multistep__form .input__grid');
const nextBtn = document.querySelectorAll('.form-next');
const prevBtn = document.querySelectorAll('.form-prev');
const formHeaderList = document.querySelectorAll('#form__steps li');
const formHeaderLink = document.querySelectorAll('.form-link');
const submitBtn = document.querySelectorAll('#btn__submit');

let formStepCount = 0;

nextBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        formStepCount++;
        updateForm();
        updateFormTitle();
        console.log(formStepCount)
    })
})

prevBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        formStepCount--;
        updateForm();
        updateFormTitle();
    })
})

formHeaderLink.forEach((btn) => {
    btn.addEventListener('click', () => {
        formStepCount++;
        updateForm();
        updateFormTitle();
    })
})

function updateForm(){
    formStep.forEach(formSteps => {
        formSteps.classList.contains('formActive') &&
            formSteps.classList.remove('formActive');
    });

    formStep[formStepCount].classList.add('formActive');

    if(document.querySelector('.successful-form').classList.contains('formActive')){
        document.querySelector('#form__steps').style.display= 'none';
    } else{
        document.querySelector('#form__steps').style.display= 'flex';  
    }
}

function updateFormTitle(){
    formHeaderList.forEach((formHeaderLists, i) => {
        if(i < formStepCount + 1 ){
            formHeaderLists.classList.add('active');
        } else{
            formHeaderLists.classList.remove('active');
        }
    })

    formHeaderList.forEach((formHeaderLists, i)=> {
        if (i < formStepCount) { 
            formHeaderLists.classList.add("formCompleted"); 
        }
        else { 
            formHeaderLists.classList.remove("formCompleted"); 
        }
    }); 
}
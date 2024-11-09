const signInButton=document.getElementById("signInButton");
const signUpButton=document.getElementById("signUpButton");
const signInForm=document.getElementById("signin");
const signUpForm=document.getElementById("signup");
signInButton.addEventListener("click",()=>{
    signUpForm.style.display="none";
    signInForm.style.display="block";
});
signUpButton.addEventListener("click",()=>{
    signInForm.style.display="none";
    signUpForm.style.display="block";
});
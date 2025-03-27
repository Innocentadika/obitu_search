document.getElementById("obituaryForm").addEventListener("submit", function(event) {
    const name = document.getElementById("name").value;
    const dob = document.getElementById("dob").value;
    const dod = document.getElementById("dod").value;
    const content = document.getElementById("content").value;
    const author = document.getElementById("author").value;

    
    if (!name || !dob || !dod || !content || !author) {
        alert("All fields are required.");
        event.preventDefault(); 
    }

    
    if (new Date(dod) < new Date(dob)) {
        alert("Date of Death cannot be earlier than Date of Birth.");
        event.preventDefault(); 
    }
});

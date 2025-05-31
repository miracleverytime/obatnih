    const form = document.querySelector("form");

    const namaField = form.querySelector(".nama"),
          namaInput = namaField ? namaField.querySelector("input") : null,
          eField = form.querySelector(".email"),
          eInput = eField.querySelector("input"),
          pField = form.querySelector(".password"),
          pInput = pField.querySelector("input"),
          // Tambahan untuk verify password
          vpField = form.querySelector(".verify-password"),
          vpInput = vpField ? vpField.querySelector("input") : null,
          dobField = form.querySelector(".dob"),
          dobInput = dobField ? dobField.querySelector("input") : null,
          phoneField = form.querySelector(".phone"),
          phoneInput = phoneField ? phoneField.querySelector("input") : null;

    // Password toggle functionality untuk password utama
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const iconElement = this.querySelector('i');
        if (passwordInput.getAttribute('type') === 'password') {
          iconElement.classList.remove('fa-eye-slash');
          iconElement.classList.add('fa-eye');
        } else {
          iconElement.classList.remove('fa-eye');
          iconElement.classList.add('fa-eye-slash');
        }
      });
    }

    // Password toggle functionality untuk verify password
    const toggleVerifyPassword = document.getElementById('toggleVerifyPassword');
    const verifyPasswordInput = document.getElementById('verify-password');

    if (toggleVerifyPassword && verifyPasswordInput) {
      toggleVerifyPassword.addEventListener('click', function() {
        const type = verifyPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        verifyPasswordInput.setAttribute('type', type);
        
        const iconElement = this.querySelector('i');
        if (verifyPasswordInput.getAttribute('type') === 'password') {
          iconElement.classList.remove('fa-eye-slash');
          iconElement.classList.add('fa-eye');
        } else {
          iconElement.classList.remove('fa-eye');
          iconElement.classList.add('fa-eye-slash');
        }
      });
    }

    // VALIDATION FUNCTIONS
    function checkNama() { 
      if(!namaInput || namaInput.value == "") { 
        if(namaField) {
          namaField.classList.add("error");
          namaField.classList.remove("valid");
        }
      } else { 
        namaField.classList.remove("error");
        namaField.classList.add("valid");
      }
    }

    function checkEmail() { 
      let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; 
      if(!eInput.value.match(pattern)) { 
        eField.classList.add("error");
        eField.classList.remove("valid");
        let errorTxt = eField.querySelector(".error-txt");
        if(errorTxt) {
          (eInput.value != "") ? errorTxt.innerText = "Masukkan email yang valid" : errorTxt.innerText = "Email tidak boleh kosong";
        }
      } else { 
        eField.classList.remove("error");
        eField.classList.add("valid");
      }
    }

    function checkPass() { 
      if (pInput.value === "" || pInput.value.length < 8) { 
        pField.classList.add("error");
        pField.classList.remove("valid");
        let errorTxt = pField.querySelector(".error-txt");
        if(errorTxt) {
          (pInput.value != "") ? errorTxt.innerText = "Password minimal 8 karakter" : errorTxt.innerText = "Password tidak boleh kosong";
        }
      } else { 
        pField.classList.remove("error");
        pField.classList.add("valid");
      }
    }

    // Fungsi baru untuk validasi verify password
    function checkVerifyPass() { 
      if(!vpInput || vpInput.value === "") { 
        if(vpField) {
          vpField.classList.add("error");
          vpField.classList.remove("valid");
          let errorTxt = vpField.querySelector(".error-txt");
          if(errorTxt) {
            errorTxt.innerText = "Konfirmasi password tidak boleh kosong";
          }
        }
      } else if(vpInput.value !== pInput.value) {
        vpField.classList.add("error");
        vpField.classList.remove("valid");
        let errorTxt = vpField.querySelector(".error-txt");
        if(errorTxt) {
          errorTxt.innerText = "Password tidak sama";
        }
      } else { 
        vpField.classList.remove("error");
        vpField.classList.add("valid");
      }
    }

    function checkDob() { 
      if(!dobInput || dobInput.value == "") { 
        if(dobField) {
          dobField.classList.add("error");
          dobField.classList.remove("valid");
        }
      } else { 
        dobField.classList.remove("error");
        dobField.classList.add("valid");
      }
    }

    function checkPhone() { 
      let pattern = /^[0-9]{10,14}$/;
      if(!phoneInput || !phoneInput.value.match(pattern)) { 
        if(phoneField) {
          phoneField.classList.add("error");
          phoneField.classList.remove("valid");
          let errorTxt = phoneField.querySelector(".error-txt");
          if(errorTxt) {
            (phoneInput.value != "") ? errorTxt.innerText = "Masukkan no. Telepon yang valid" : errorTxt.innerText = "No. tidak boleh kosong";
          }
        }
      } else { 
        phoneField.classList.remove("error");
        phoneField.classList.add("valid");
      }
    }

    // EVENT LISTENERS UNTUK REAL-TIME VALIDATION
    if (namaInput) namaInput.onkeyup = () => { checkNama(); }
    if (eInput) eInput.onkeyup = () => { checkEmail(); }
    if (pInput) {
      pInput.onkeyup = () => { 
        checkPass(); 
        // Juga check verify password ketika password berubah
        if(vpInput && vpInput.value !== "") checkVerifyPass(); 
      }
    }
    // Event listener untuk verify password
    if (vpInput) vpInput.onkeyup = () => { checkVerifyPass(); }
    if (dobInput) dobInput.onchange = () => { checkDob(); }
    if (phoneInput) phoneInput.onkeyup = () => { checkPhone(); }

    // FORM SUBMIT HANDLER
    form.onsubmit = (e) => {
      e.preventDefault();

      // Check semua field dan tambah shake effect
      if (namaField && namaInput) { 
        (namaInput.value == "") ? namaField.classList.add("shake", "error") : checkNama();
        setTimeout(() => { namaField.classList.remove("shake"); }, 500);
      }

      (eInput.value == "") ? eField.classList.add("shake", "error") : checkEmail();
      (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();
      
      // Check verify password
      if (vpField && vpInput) {
        (vpInput.value == "" || vpInput.value !== pInput.value) ? vpField.classList.add("shake", "error") : checkVerifyPass();
        setTimeout(() => { vpField.classList.remove("shake"); }, 500);
      }

      if (dobField && dobInput) {
        (dobInput.value == "") ? dobField.classList.add("shake", "error") : checkDob();
        setTimeout(() => { dobField.classList.remove("shake"); }, 500);
      }

      if (phoneField && phoneInput) {
        (phoneInput.value == "") ? phoneField.classList.add("shake", "error") : checkPhone();
        setTimeout(() => { phoneField.classList.remove("shake"); }, 500);
      }

      // Remove shake effect
      setTimeout(() => { 
        eField.classList.remove("shake");
        pField.classList.remove("shake");
      }, 500);

      // Submit jika semua valid
      if((!namaField || !namaField.classList.contains("error")) &&
         !eField.classList.contains("error") &&
         !pField.classList.contains("error") &&
         (!vpField || !vpField.classList.contains("error")) &&
         (!dobField || !dobField.classList.contains("error")) &&
         (!phoneField || !phoneField.classList.contains("error"))) {
        form.submit();
      }
    }
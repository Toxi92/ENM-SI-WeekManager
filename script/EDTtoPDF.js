function loadScript(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
}

async function setupEDTPDF() {
    // Charge jsPDF et html2canvas si pas déjà présents
    if (typeof window.jspdf === "undefined") {
        await loadScript("https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js");
    }
    if (typeof window.html2canvas === "undefined") {
        await loadScript("https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js");
    }
    if (typeof window.printJS === "undefined") {
        await loadScript("https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js");
    }


    let btnContainer = document.getElementById('edt-btn-container');
    if (!btnContainer) {
        btnContainer = document.createElement('div');
        btnContainer.id = 'edt-btn-container';
        btnContainer.style.display = 'flex';
        btnContainer.style.justifyContent = 'center';
        btnContainer.style.gap = '20px';
        btnContainer.style.margin = '30px auto 60px auto';
        // Ajoute le conteneur juste après l'EDT
        const edtDiv = document.getElementsByClassName('DivEmploiDuTemps')[0];
        if (edtDiv && edtDiv.parentNode) {
            edtDiv.parentNode.insertBefore(btnContainer, edtDiv.nextSibling);
        } else {
            document.body.appendChild(btnContainer);
        }
    }

    // Ajoute le bouton Télécharger si besoin
    if (!document.getElementById('btnEDTPDF')) {
        const btn = document.createElement('button');
        btn.id = 'btnEDTPDF';
        btn.textContent = jsTranslations.download;
        btn.onclick = downloadEDTPDF;
        btnContainer.appendChild(btn);
    }

    // Ajoute le bouton Imprimer si besoin
    if (!document.getElementById('btnPrintPDF')) {
        const btnPrint = document.createElement('button');
        btnPrint.id = 'btnPrintPDF';
        btnPrint.textContent = jsTranslations.print;
        btnPrint.onclick = () => {
            const edt = document.getElementsByClassName('DivEmploiDuTemps')[0];
            if (!edt) {
                alert("Emploi du temps introuvable !");
                return;
            }
            window.printJS({ printable: edt, type: 'html', targetStyles: ['*'], css:[ '/../styles/style.css'] });
        };
        btnContainer.appendChild(btnPrint);
    }
}

function downloadEDTPDF() {
    const edt = document.getElementsByClassName('DivEmploiDuTemps')[0];
    if (!edt) {
        alert("Emploi du temps introuvable !");
        return;
    }
    window.html2canvas(edt).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new window.jspdf.jsPDF('p', 'mm', 'a4');
        const pageWidth = pdf.internal.pageSize.getWidth();
        const imgWidth = pageWidth;
        const imgHeight = canvas.height * imgWidth / canvas.width;
        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
        pdf.save('edt.pdf');
    });
}

// Lance le setup au chargement de la page
window.addEventListener('DOMContentLoaded', setupEDTPDF);
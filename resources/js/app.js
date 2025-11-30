import './bootstrap';

import PDFObject from 'pdfobject';

window.PDFObject = PDFObject;

document.addEventListener('alpine:init', () => {
    // Auto-load PDF Viewer
    Alpine.data('pdfViewer', (pdfUrl = '') => ({
        isLoaded: false,
        pdfUrl: pdfUrl,

        init() {
            // Auto load PDF saat component di-mount
            if (this.pdfUrl) {
                this.loadPDF(this.pdfUrl);
            }
        },

        loadPDF(url) {
            if (!url) return;

            this.pdfUrl = url;
            const options = {
                height: "100%",
                pdfOpenParams: {
                    view: 'FitH',
                    pagemode: 'none',
                    toolbar: 1
                },
                fallbackLink: '<p>Browser tidak support PDF. <a href="[url]">Download PDF</a></p>'
            };

            const success = PDFObject.embed(url, this.$refs.pdfContainer, options);
            this.isLoaded = success;
        },

        closePDF() {
            if (this.$refs.pdfContainer) {
                this.$refs.pdfContainer.innerHTML = '';
            }
            this.isLoaded = false;
        }
    }));

    // Auto-load PDF Selector
    Alpine.data('pdfSelector', (defaultPdf = '') => ({
        selectedPDF: defaultPdf,

        init() {
            if (this.selectedPDF) {
                this.changePDF();
            }
        },

        changePDF() {
            if (this.selectedPDF && this.$refs.viewer) {
                PDFObject.embed(this.selectedPDF, this.$refs.viewer, {
                    height: "700px",
                    pdfOpenParams: {
                        view: 'FitH'
                    }
                });
            }
        }
    }));

    // Advanced Auto-load PDF Viewer
    Alpine.data('advancedPDFViewer', (initialUrl = '') => ({
        isLoaded: false,
        pdfUrl: initialUrl,

        init() {
            if (this.pdfUrl) {
                this.loadPDF(this.pdfUrl);
            }
        },

        loadPDF(url) {
            if (!url) return;

            this.pdfUrl = url;
            const options = {
                height: "800px",
                pdfOpenParams: {
                    view: 'FitH',
                    pagemode: 'none',
                    toolbar: 1
                },
                fallbackLink: '<p>Browser tidak mendukung PDF. <a href="[url]">Download PDF</a></p>'
            };

            const success = PDFObject.embed(url, this.$refs.pdfDisplay, options);
            this.isLoaded = success;
        }
    }));

    // Filament Auto-load
    Alpine.data('filamentPDFViewer', (defaultDoc = '') => ({
        selectedDoc: defaultDoc,

        init() {
            if (this.selectedDoc) {
                this.loadDocument();
            }
        },

        loadDocument() {
            if (this.selectedDoc && this.$refs.pdfDisplay) {
                PDFObject.embed(this.selectedDoc, this.$refs.pdfDisplay, {
                    height: "700px",
                    pdfOpenParams: {
                        view: 'FitH',
                        toolbar: 1
                    }
                });
            }
        }
    }));
});

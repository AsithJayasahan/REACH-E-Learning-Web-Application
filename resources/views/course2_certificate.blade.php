<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Digital Finance Education - Course Completion</title>
       <!-- Favicon -->
    <link href="img/3541249.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .certificate-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 50px;
            text-align: center;
        }
        .certificate-icon {
            font-size: 4rem;
            color: #06BBCC;
            margin-bottom: 20px;
        }
        .btn-certificate {
            background: linear-gradient(135deg, #06BBCC, #059ba8);
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-certificate:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(6, 187, 204, 0.2);
        }
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        #completeCourseBtn {
            margin: 20px 0;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="certificate-container">
                    <div class="certificate-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h1 class="mb-4">Course Completed!</h1>
                    <p class="lead mb-4">Congratulations on completing the Digital Finance Education course!</p>
                    <p class="text-muted mb-4">Click the button below to generate your personalized certificate.</p>

                    <button class="btn btn-certificate text-white rounded-pill" data-bs-toggle="modal" data-bs-target="#certificateModal">
                        <i class="fas fa-download me-2"></i> Get Your Certificate
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Modal -->
    <div class="modal fade" id="certificateModal" tabindex="-1" aria-labelledby="certificateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="w-100">
                        <i class="fas fa-certificate text-primary mb-3" style="font-size: 3rem;"></i>
                        <h5 class="modal-title w-100" id="certificateModalLabel">Personalize Your Certificate</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="certificateForm">
                        <div class="mb-3">
                            <label for="recipientName" class="form-label">Your Full Name</label>
                            <input type="text" class="form-control form-control-lg" id="recipientName"
                                   value="{{ Auth::user()->name ?? '' }}" required>
                            <div class="form-text">This name will appear on your certificate</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill" id="generateCertificateBtn">
                        <i class="fas fa-download me-2"></i> Generate Certificate
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to open the certificate image
        function showCertificateImage() {
            // Create a modal-like overlay
            const overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0,0,0,0.8)';
            overlay.style.zIndex = '9999';
            overlay.style.display = 'flex';
            overlay.style.justifyContent = 'center';
            overlay.style.alignItems = 'center';

            // Create the image container
            const imgContainer = document.createElement('div');
            imgContainer.style.position = 'relative';
            imgContainer.style.maxWidth = '90%';
            imgContainer.style.maxHeight = '90%';

            // Create the close button
            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '&times;';
            closeBtn.style.position = 'absolute';
            closeBtn.style.top = '-40px';
            closeBtn.style.right = '0';
            closeBtn.style.background = 'none';
            closeBtn.style.border = 'none';
            closeBtn.style.color = 'white';
            closeBtn.style.fontSize = '30px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = function() {
                document.body.removeChild(overlay);
            };

            // Create the image element
            const img = document.createElement('img');
            img.src = 'image.png';
            img.style.maxWidth = '100%';
            img.style.maxHeight = '90vh';
            img.style.borderRadius = '10px';
            img.style.boxShadow = '0 0 20px rgba(0,0,0,0.5)';

            // Assemble the elements
            imgContainer.appendChild(closeBtn);
            imgContainer.appendChild(img);
            overlay.appendChild(imgContainer);

            // Add to document
            document.body.appendChild(overlay);

            // Close when clicking outside the image
            overlay.onclick = function(e) {
                if (e.target === overlay) {
                    document.body.removeChild(overlay);
                }
            };
        }



        document.getElementById('generateCertificateBtn').addEventListener('click', async function() {
            const userName = document.getElementById('recipientName').value.trim();

            if (!userName) {
                alert('Please enter your name to generate the certificate');
                return;
            }

            try {
                // Show loading state
                const btn = this;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Generating...';
                btn.disabled = true;

                const certificateData = {
                    name: userName,
                    course: "Digital Finance Education ",
                    completionDate: new Date().toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }),
                    duration: "6 Modules",
                    certificateId: "DFE-" + Math.random().toString(36).substr(2, 8).toUpperCase()
                };

                const response = await fetch('/generate-certificate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/pdf'
                    },
                    body: JSON.stringify(certificateData)
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `Digital Finance Education_Certificate_${certificateData.certificateId}.pdf`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);

                // Close modal and reset button
                bootstrap.Modal.getInstance(document.getElementById('certificateModal')).hide();
                btn.innerHTML = '<i class="fas fa-download me-2"></i> Generate Certificate';
                btn.disabled = false;

                // Show success toast (you can implement toast notifications if needed)
                console.log('Certificate downloaded successfully');

            } catch (error) {
                console.error('Certificate generation failed:', error);
                alert('Failed to generate certificate. Please try again or contact support.');

                // Reset button on error
                const btn = document.getElementById('generateCertificateBtn');
                btn.innerHTML = '<i class="fas fa-download me-2"></i> Generate Certificate';
                btn.disabled = false;
            }
        });
    </script>
</body>
</html>

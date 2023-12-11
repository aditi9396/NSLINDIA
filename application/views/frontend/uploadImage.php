<!DOCTYPE html>
<html>
<head>
    <title>Take Photo and Display</title>
    <style>
     .container {
        text-align: center;
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    h2 {
        margin-bottom: 10px;
    }
    video {
        display: block;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    img {
        display: block;
        margin: 10px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 250px;
        height: 250px;
    }
    button {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        background-color: #ff8100;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #open-camera {
        background-color: #ff8100;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="upload-container">
            <button id="open-camera">Open Camera</button>
        </div>

        <div class="camera-container" style="display: none;">
            <video id="video" width="250" height="250" autoplay></video>
            <button id="capture-btn">Capture Photo</button>
        </div>

        <div class="result-container" style="display: none;">
            <img id="photo"  alt="Your Photo">
            <br>
            <!-- <button id="">Save Photo</button> -->
            <input type="submit" id="save-btn" name="Submit" onclick="savePhoto()" value="save-btn"  >
        </div>
    </div>

    <script type="text/javascript">
        const openCameraBtn = document.getElementById('open-camera');
        const cameraContainer = document.querySelector('.camera-container');
        const captureBtn = document.getElementById('capture-btn');
        const uploadContainer = document.querySelector('.upload-container');
        const photo = document.getElementById('photo');
        const resultContainer = document.querySelector('.result-container');

        openCameraBtn.addEventListener('click', () => {
            cameraContainer.style.display = 'block';
            openCameraBtn.style.display = 'block';
            startVideo();
        });

        captureBtn.addEventListener('click', () => {
            capturePhoto();
        });

        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');

        async function startVideo() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                video.play();
            } catch (error) {
                console.error('Error accessing the camera:', error);
            }
        }

        var photoData= "";

        function capturePhoto() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            photo.src = canvas.toDataURL('uploads/');
            cameraContainer.style.display = 'none';
            resultContainer.style.display = 'block';
        }
    </script>
    <script type="text/javascript">
        function savePhoto() {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('save_photo'); ?>', 
                data: {
                    photo: photoData
                },
                success: function(response) {
                    console.log('Photo saved successfully:', response);

                    if (response.success) {
                        alert('Photo saved to database!');
                    } else {
                        alert('Error saving photo to database.');
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error saving photo:', error);
                }
            });
        }

    </script>
</body>
</html>

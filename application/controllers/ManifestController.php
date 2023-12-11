<?php
class ManifestController extends CI_Controller {
    public function manifest() {
        $this->output->set_content_type('application/json');
        $manifest = '{
            "name": "NSLINDIA",
            "short_name": "NSLINDIA",
            "start_url": ".",
            "background_color": "#6dcdb1",
            "theme_color": "#009578",
            "display": "standalone",
            "icons": [
                {
                    "src": "images/logo192.png",
                    "sizes": "192x192",
                    "type": "image/png"
                },
                {
                    "src": "images/logo512.png",
                    "sizes": "512x512",
                    "type": "image/png"
                }
            ]
        }';
        $this->output->set_output($manifest);
    }
}

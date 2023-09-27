import { Controller } from './node_modules/stimulus/index.d.ts';

export default class extends Controller {
    upload(event) {
        if (!event?.attachment?.file) {
            return;
        }

        this._uploadFile(event.attachment);
    }

    _uploadFile(attachment) {
        const form = new FormData();
        form.append('attachment', attachment.file);

        window.axios.post('/attachments', form, {
            onUploadProgress: (progressEvent) => {
                attachment.setUploadProgress(progressEvent.loaded / progressEvent.total * 100);
            }
        }).then(resp => {
            attachment.setAttributes({
                url: resp.data.image_url,
                href: resp.data.image_url,
            });
        });
    }
}

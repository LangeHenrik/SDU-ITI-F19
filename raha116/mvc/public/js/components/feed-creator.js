import {BaseComponent} from "../framework/base-component.js";
import {FeedService} from "../services/feed-service.js";
import {getDataUrl} from "../services/files.js";
import {FormHandler} from "../services/form-handler.js";

const template = `<style>
    @import url('./style/forms.css');

    .image-preview {
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .image-preview.has-image {
        padding-top: 56.75%;
        margin-bottom: 1rem;
    }
</style>

<form class="body form" id="create-feed-entry-form">

    <div class="input-wrapper">
        <input class="input" id="title-input" name="title" placeholder="Title" required>
    </div>

    <div class="input-wrapper">
        <textarea class="input" id="description-input" name="description" placeholder="Description"></textarea required>
    </div>
    
    <div class="image-preview">
        
    </div>

    <div class="input-wrapper">
        <zl-button id="attach-image-button">Attach image</zl-button>
        <input style="display: none" type="file" id="image-input" name="image" accept="image/jpeg,image/png" required>
    </div>
    
    <zl-button id="form-submit-button">
        Submit
    </zl-button>
</form>
`;

export class FeedCreator extends BaseComponent {

    static FEED_ENTRY_CREATED_EVENT_NAME = 'feedEntryCreated';

    constructor() {
        super(template);

        this.form = this.shadow.querySelector('#create-feed-entry-form');

        this.submitButton = this.shadow.querySelector('#form-submit-button');

        this.fileInput = this.shadow.querySelector('#image-input');

        this.fileInputButton = this.shadow.querySelector('#attach-image-button');

        this.imagePreview = this.shadow.querySelector('.image-preview');

        this.formHandler = new FormHandler(this.form, this.submitButton);
    }

    connectedCallback() {
        super.connectedCallback();

        this.fileInput.addEventListener('change', async () => {
            const file = this.fileInput.files[0];
            if (!file) {
                return;
            }

            if (file.size > 10 * 1000 * 1000) {
                this.imagePreview.style.backgroundImage = '';
                this.imagePreview.classList.remove('has-image');
                this.imagePreview.innerText = 'Image is too large to preview';
                return;
            } else {
                this.imagePreview.innerHTML = '';
            }

            const url = await getDataUrl(file);

            this.imagePreview.style.backgroundImage = `url(${url})`;
            this.imagePreview.classList.add('has-image');

        });

        this.fileInputButton.addEventListener('click', () => this.fileInput.click());

        this.form.addEventListener('submit', async e => {
            e.preventDefault();

            const {title, description, image} = this.formHandler.getValues();

            if (!title.trim() || !description.trim() || !image) {
                return;
            }


            try {
                const entry = await FeedService.instance.addFeedEntry(image, title, description, ({total, loaded, percent}) => {
                    console.log({total, loaded, percent});
                });
                this.dispatchEvent(new CustomEvent(FeedCreator.FEED_ENTRY_CREATED_EVENT_NAME, {
                    detail: {entry}
                }));

                this.formHandler.clear();
                this.imagePreview.innerHTML = '';
                this.imagePreview.classList.remove('has-image');
                this.imagePreview.style.backgroundImage = '';
            } catch (e) {
                alert(e);
            }

        });
    }


}

customElements.define('zl-feed-creator', FeedCreator);
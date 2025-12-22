// assets/controllers/ckeditor_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  editor = null;

  async connect() {
    // CKEditor doit être chargé via <script> (voir base.html.twig)
    if (!window.ClassicEditor) {
      console.error('CKEditor ClassicEditor introuvable. Vérifie le <script> CKEditor dans base.html.twig');
      return;
    }

    this.editor = await window.ClassicEditor.create(this.element, {
      // config minimale; tu pourras étendre (toolbar, etc.)
    });
  }

  async disconnect() {
    if (this.editor) {
      await this.editor.destroy();
      this.editor = null;
    }
  }
}

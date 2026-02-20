import Link from '@tiptap/extension-link'
import Image from '@tiptap/extension-image'
import { initLaravelFilemanager } from '../../vendor/darvis/livewire-flux-editor-filemanager/resources/js/laravel-filemanager.js'
import '../../vendor/darvis/livewire-flux-editor-filemanager/resources/css/tiptap-image.css'
import '../../vendor/darvis/livewire-flux-editor-filemanager/resources/css/file-link-modal.css'

// flux-filemanager:start
const FluxSafeImage = Image.extend({
    addAttributes() {
        return {
            ...this.parent?.(),
            width: {
                default: null,
                parseHTML: element => element.getAttribute('width'),
                renderHTML: attributes => {
                    if (!attributes.width) return {}
                    return { width: attributes.width }
                },
            },
            class: {
                default: 'tiptap-image',
                parseHTML: element => element.getAttribute('class') || 'tiptap-image',
                renderHTML: attributes => {
                    if (!attributes.class) return { class: 'tiptap-image' }
                    return { class: attributes.class }
                },
            },
            style: {
                default: null,
                parseHTML: element => element.getAttribute('style'),
                renderHTML: attributes => {
                    if (!attributes.style) return {}
                    return { style: attributes.style }
                },
            },
            'data-align': {
                default: null,
                parseHTML: element => element.getAttribute('data-align'),
                renderHTML: attributes => {
                    if (!attributes['data-align']) return {}
                    return { 'data-align': attributes['data-align'] }
                },
            },
        }
    },

    addNodeView() {
        return () => null
    },
})

document.addEventListener('flux:editor', (e) => {
    if (!e.detail?.registerExtension || e.detail.__fluxFilemanagerExtensionsRegistered) return

    e.detail.__fluxFilemanagerExtensionsRegistered = true

    e.detail.registerExtension(Link.configure({
        openOnClick: false,
        HTMLAttributes: {
            rel: 'noopener noreferrer nofollow',
        },
    }).extend({
        addAttributes() {
            return {
                ...this.parent?.(),
                target: {
                    default: '_blank',
                    parseHTML: element => element.getAttribute('target'),
                    renderHTML: attributes => {
                        if (!attributes.target) return {}
                        return { target: attributes.target }
                    },
                },
                class: {
                    default: null,
                    parseHTML: element => element.getAttribute('class'),
                    renderHTML: attributes => {
                        if (!attributes.class) return {}
                        return { class: attributes.class }
                    },
                },
                style: {
                    default: null,
                    parseHTML: element => element.getAttribute('style'),
                    renderHTML: attributes => {
                        if (!attributes.style) return {}
                        return { style: attributes.style }
                    },
                },
            }
        },
    }))

    e.detail.registerExtension(FluxSafeImage.configure({
        inline: true,
        allowBase64: true,
        resize: false,
        HTMLAttributes: {
            class: 'tiptap-image',
        },
    }))
})
// flux-filemanager:end

initLaravelFilemanager()

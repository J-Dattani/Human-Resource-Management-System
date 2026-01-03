/**
 * Dayflow Helper Utilities
 */

const Utils = {
    /**
     * DOM Selector Helper
     */
    select: (selector, all = false) => {
        selector = selector.trim();
        if (all) {
            return [...document.querySelectorAll(selector)];
        } else {
            return document.querySelector(selector);
        }
    },

    /**
     * Event Listener Helper
     */
    on: (type, el, listener, all = false) => {
        let selectEl = el;
        if (typeof selectEl === 'string') {
            selectEl = Utils.select(selectEl, all);
        }
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    }
};

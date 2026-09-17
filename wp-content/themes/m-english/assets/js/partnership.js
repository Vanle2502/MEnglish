document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.partnership-form form.frm-fluent-form');
    if (!form) return;

    const enhancePosition = () => {
        const select = form.querySelector('select[name="dropdown"]');
        if (!select || select.closest('.partnership-position')) return;

        const wrapper = document.createElement('div');
        wrapper.className = 'partnership-position';
        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'partnership-position__trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        trigger.textContent = select.options[select.selectedIndex]?.text || 'Chọn chức vụ';
        const list = document.createElement('div');
        list.className = 'partnership-position__list';
        list.setAttribute('role', 'listbox');

        [...select.options].forEach((option) => {
            if (!option.value) return;
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'partnership-position__option';
            item.dataset.value = option.value;
            item.setAttribute('role', 'option');
            item.setAttribute('aria-selected', String(option.selected));
            item.textContent = option.text;
            list.append(item);
        });

        select.before(wrapper);
        wrapper.append(trigger, list, select);
        trigger.addEventListener('click', () => {
            const open = !wrapper.classList.contains('is-open');
            wrapper.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', String(open));
        });
        list.addEventListener('click', (event) => {
            const item = event.target.closest('.partnership-position__option');
            if (!item) return;
            select.value = item.dataset.value;
            select.dispatchEvent(new Event('change', {bubbles:true}));
            trigger.textContent = item.textContent;
            list.querySelectorAll('[role="option"]').forEach((option) => {
                const selected = option === item;
                option.classList.toggle('is-selected', selected);
                option.setAttribute('aria-selected', String(selected));
            });
            wrapper.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
        });
        document.addEventListener('click', (event) => {
            if (!wrapper.contains(event.target)) {
                wrapper.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
            }
        });
        wrapper.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                wrapper.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
                trigger.focus();
            }
        });
    };

    const enhancePackages = () => {
        const choices = form.querySelector('.choices[data-type="select-multiple"]');
        if (!choices || choices.classList.contains('is-package-enhanced')) return;
        const items = [...choices.querySelectorAll('.choices__item--choice[data-value]')];
        if (!items.length) return;

        const grid = document.createElement('div');
        grid.className = 'partnership-package-grid';
        grid.setAttribute('role', 'group');
        items.forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'partnership-package-option';
            button.dataset.value = item.dataset.value;
            button.setAttribute('role', 'checkbox');
            button.setAttribute('aria-checked', 'false');
            button.innerHTML = `<span>${item.textContent.trim()}</span><i aria-hidden="true"></i>`;
            grid.append(button);
        });
        choices.before(grid);
        choices.classList.add('is-package-enhanced');
        const select = choices.querySelector('select[multiple]');
        const instance = select && window.jQuery ? window.jQuery(select).data('choicesjs') : null;
        const sync = () => {
            const selected = new Set([...choices.querySelectorAll('.choices__list--multiple [data-value]')].map(item => item.dataset.value));
            grid.querySelectorAll('button').forEach((button) => {
                const checked = selected.has(button.dataset.value);
                button.classList.toggle('is-selected', checked);
                button.setAttribute('aria-checked', String(checked));
            });
        };
        grid.addEventListener('click', (event) => {
            const button = event.target.closest('button');
            if (!button) return;
            const checked = button.getAttribute('aria-checked') === 'true';
            button.classList.toggle('is-selected', !checked);
            button.setAttribute('aria-checked', String(!checked));
            if (instance) checked ? instance.removeActiveItemsByValue(button.dataset.value) : instance.setChoiceByValue(button.dataset.value);
            select?.dispatchEvent(new Event('change', {bubbles:true}));
            setTimeout(sync, 30);
        });
        new MutationObserver(sync).observe(choices,{childList:true,subtree:true});
        sync();
    };
    enhancePosition();
    enhancePackages();
    new MutationObserver(enhancePackages).observe(form,{childList:true,subtree:true});
});

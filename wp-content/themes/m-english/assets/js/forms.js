document.addEventListener('DOMContentLoaded', () => {
    const i18n = window.mEnglishFormI18n || {};
    const fieldLabels = {
        name: i18n.name || 'Họ tên',
        phone: i18n.phone || 'Số điện thoại',
        school: i18n.school || 'Tên trường',
        city: i18n.city || 'Tỉnh/Thành phố',
    };

    document.querySelectorAll('.consultation-form').forEach((section) => {
        Object.entries(fieldLabels).forEach(([name, text]) => {
            const input = section.querySelector(`[name="${name}"]`);
            const content = input?.closest('.ff-el-input--content');

            if (!input || !content || content.querySelector('.m-english-field-label')) {
                return;
            }

            const label = document.createElement('label');
            label.className = 'm-english-field-label';
            label.htmlFor = input.id;
            label.textContent = text;
            content.before(label);
            input.placeholder = '';
        });

        const enhanceProductSelect = () => {
            const choices = section.querySelector('.choices[data-type="select-multiple"]');
            if (!choices || choices.classList.contains('is-product-enhanced')) {
                return;
            }

            const sourceItems = [...choices.querySelectorAll('.choices__item--choice[data-value]')];
            if (!sourceItems.length) {
                return;
            }

            const products = [...new Map(sourceItems.map((item) => [
                item.dataset.value,
                item.textContent.trim(),
            ])).entries()];
            const grid = document.createElement('div');
            grid.className = 'm-english-product-grid';
            grid.setAttribute('role', 'group');
            grid.setAttribute('aria-label', i18n.productLabel || 'Lựa chọn sản phẩm quan tâm');

            products.forEach(([value, label]) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'm-english-product-option';
                button.dataset.value = value;
                button.setAttribute('role', 'checkbox');
                button.setAttribute('aria-checked', 'false');
                button.innerHTML = `<span>${label}</span><i aria-hidden="true"></i>`;
                grid.append(button);
            });

            choices.before(grid);
            choices.classList.add('is-product-enhanced');
            const select = choices.querySelector('select[multiple]');
            const choicesInstance = select && window.jQuery
                ? window.jQuery(select).data('choicesjs')
                : null;

            const selectedValues = () => new Set(
                [...choices.querySelectorAll('.choices__list--multiple .choices__item[data-value]')]
                    .map((item) => item.dataset.value)
            );

            const sync = () => {
                const selected = selectedValues();
                grid.querySelectorAll('.m-english-product-option').forEach((button) => {
                    const checked = selected.has(button.dataset.value);
                    button.classList.toggle('is-selected', checked);
                    button.setAttribute('aria-checked', String(checked));
                });
            };

            grid.addEventListener('click', (event) => {
                const button = event.target.closest('.m-english-product-option');
                if (!button) {
                    return;
                }

                const value = button.dataset.value;
                const checked = button.getAttribute('aria-checked') === 'true';

                // Update the custom control immediately, then synchronize Choices.js.
                button.classList.toggle('is-selected', !checked);
                button.setAttribute('aria-checked', String(!checked));

                if (choicesInstance) {
                    if (checked) {
                        choicesInstance.removeActiveItemsByValue(value);
                    } else {
                        choicesInstance.setChoiceByValue(value);
                    }
                } else if (select) {
                    const option = [...select.options].find((item) => item.value === value);
                    if (option) {
                        option.selected = !checked;
                    }
                }

                select?.dispatchEvent(new Event('change', { bubbles: true }));
                window.setTimeout(sync, 30);
            });

            new MutationObserver(sync).observe(choices, {
                childList: true,
                subtree: true,
            });
            sync();
        };

        enhanceProductSelect();
        new MutationObserver(enhanceProductSelect).observe(section, {
            childList: true,
            subtree: true,
        });

        const form = section.querySelector('form.frm-fluent-form');
        if (!form) {
            return;
        }

        const removeError = (element) => {
            element?.classList.remove('is-invalid');
            element?.removeAttribute('aria-invalid');
            element?.parentElement?.querySelector('.m-english-validation-error')?.remove();
        };

        const showError = (element, message) => {
            removeError(element);
            element.classList.add('is-invalid');
            element.setAttribute('aria-invalid', 'true');
            const error = document.createElement('div');
            error.className = 'm-english-validation-error';
            error.setAttribute('role', 'alert');
            error.textContent = message;
            element.insertAdjacentElement('afterend', error);
        };

        const fields = {
            name: form.querySelector('[name="name"]'),
            phone: form.querySelector('[name="phone"]'),
            school: form.querySelector('[name="school"]'),
            city: form.querySelector('[name="city"]'),
        };

        Object.values(fields).forEach((input) => {
            input?.setAttribute('aria-required', 'true');
            input?.addEventListener('input', () => removeError(input));
        });

        form.addEventListener('submit', (event) => {
            const productGrid = section.querySelector('.m-english-product-grid');
            const failures = [];
            const requiredMessages = {
                name: i18n.requiredName || 'Vui lòng nhập họ tên.',
                phone: i18n.requiredPhone || 'Vui lòng nhập số điện thoại.',
                school: i18n.requiredSchool || 'Vui lòng nhập tên trường.',
                city: i18n.requiredCity || 'Vui lòng nhập tỉnh/thành phố.',
            };

            if (productGrid && !productGrid.querySelector('.is-selected')) {
                showError(productGrid, i18n.requiredProduct || 'Vui lòng chọn ít nhất một sản phẩm.');
                failures.push(productGrid);
            } else {
                removeError(productGrid);
            }

            Object.entries(fields).forEach(([name, input]) => {
                if (!input?.value.trim()) {
                    showError(input, requiredMessages[name]);
                    failures.push(input);
                } else {
                    removeError(input);
                }
            });

            const normalizedPhone = fields.phone?.value.replace(/[^0-9+]/g, '') || '';
            if (normalizedPhone && !/^(?:\+?84|0)(?:[35789]\d{8}|2\d{9})$/.test(normalizedPhone)) {
                showError(fields.phone, i18n.invalidPhone || 'Số điện thoại chưa đúng định dạng Việt Nam.');
                failures.push(fields.phone);
            }

            if (fields.name?.value.trim() && fields.name.value.trim().length < 2) {
                showError(fields.name, i18n.shortName || 'Họ tên cần có ít nhất 2 ký tự.');
                failures.push(fields.name);
            }

            if (failures.length) {
                event.preventDefault();
                event.stopImmediatePropagation();
                failures[0].focus();
            }
        }, true);
    });
});

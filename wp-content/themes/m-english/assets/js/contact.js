document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.contact-form form.frm-fluent-form');

    const enhanceSelect = (select) => {
        if (!select || select.closest('.contact-custom-select')) return;
        const wrapper = document.createElement('div');
        wrapper.className = 'contact-custom-select';
        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'contact-custom-select__trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        trigger.textContent = select.dataset.placeholder || select.options[select.selectedIndex]?.text || '';
        const list = document.createElement('div');
        list.className = 'contact-custom-select__list';
        list.setAttribute('role', 'listbox');
        [...select.options].forEach((option) => {
            if (!option.value) return;
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'contact-custom-select__option';
            item.dataset.value = option.value;
            item.setAttribute('role', 'option');
            item.setAttribute('aria-selected', 'false');
            item.textContent = option.text;
            list.append(item);
        });
        select.before(wrapper); wrapper.append(trigger,list,select);
        trigger.addEventListener('click',()=>{const open=!wrapper.classList.contains('is-open');wrapper.classList.toggle('is-open',open);trigger.setAttribute('aria-expanded',String(open))});
        list.addEventListener('click',(event)=>{const item=event.target.closest('button');if(!item)return;select.value=item.dataset.value;select.dispatchEvent(new Event('change',{bubbles:true}));trigger.textContent=item.textContent;list.querySelectorAll('button').forEach(button=>{const active=button===item;button.classList.toggle('is-selected',active);button.setAttribute('aria-selected',String(active))});wrapper.classList.remove('is-open');trigger.setAttribute('aria-expanded','false')});
        document.addEventListener('click',(event)=>{if(!wrapper.contains(event.target)){wrapper.classList.remove('is-open');trigger.setAttribute('aria-expanded','false')}});
        wrapper.addEventListener('keydown',(event)=>{if(event.key==='Escape'){wrapper.classList.remove('is-open');trigger.setAttribute('aria-expanded','false');trigger.focus()}});
    };

    const enhanceConsultation = () => {
        const choices=form?.querySelector('.choices[data-type="select-multiple"]');
        if(!choices||choices.classList.contains('is-consultation-enhanced'))return;
        const items=[...choices.querySelectorAll('.choices__item--choice[data-value]')];if(!items.length)return;
        const unique=[...new Map(items.map(item=>[item.dataset.value,item.textContent.trim()])).entries()];
        const grid=document.createElement('div');grid.className='contact-consultation-grid';grid.setAttribute('role','group');
        unique.forEach(([value,label])=>{const button=document.createElement('button');button.type='button';button.className='contact-consultation-option';button.dataset.value=value;button.setAttribute('role','checkbox');button.setAttribute('aria-checked','false');button.innerHTML=`<span>${label}</span><i aria-hidden="true"></i>`;grid.append(button)});
        choices.before(grid);choices.classList.add('is-consultation-enhanced');const select=choices.querySelector('select[multiple]');const instance=select&&window.jQuery?window.jQuery(select).data('choicesjs'):null;
        const sync=()=>{const selected=new Set([...choices.querySelectorAll('.choices__list--multiple [data-value]')].map(item=>item.dataset.value));grid.querySelectorAll('button').forEach(button=>{const checked=selected.has(button.dataset.value);button.classList.toggle('is-selected',checked);button.setAttribute('aria-checked',String(checked))})};
        grid.addEventListener('click',(event)=>{const button=event.target.closest('button');if(!button)return;const checked=button.getAttribute('aria-checked')==='true';button.classList.toggle('is-selected',!checked);button.setAttribute('aria-checked',String(!checked));if(instance)checked?instance.removeActiveItemsByValue(button.dataset.value):instance.setChoiceByValue(button.dataset.value);select?.dispatchEvent(new Event('change',{bubbles:true}));setTimeout(sync,30)});
        new MutationObserver(sync).observe(choices,{childList:true,subtree:true});sync();
    };

    if(form){enhanceSelect(form.querySelector('[name="position"]'));enhanceSelect(form.querySelector('[name="student_count"]'));enhanceConsultation();new MutationObserver(enhanceConsultation).observe(form,{childList:true,subtree:true})}

    const slider=document.querySelector('.contact-hero__slider');
    if(slider){const slides=[...slider.querySelectorAll('.contact-hero__slide')];const dots=[...slider.querySelectorAll('.contact-hero__dots button')];const reduceMotion=window.matchMedia('(prefers-reduced-motion: reduce)');let active=0,timer,touchStart=null;const show=(next)=>{if(next===active)return;slides[active].classList.remove('is-active');slides[active].setAttribute('aria-hidden','true');dots[active].classList.remove('is-active');dots[active].removeAttribute('aria-current');active=(next+slides.length)%slides.length;slides[active].classList.add('is-active');slides[active].setAttribute('aria-hidden','false');dots[active].classList.add('is-active');dots[active].setAttribute('aria-current','true')};const stop=()=>{clearInterval(timer);timer=undefined};const start=()=>{if(!reduceMotion.matches&&!document.hidden&&!timer)timer=setInterval(()=>show(active+1),5500)};slider.querySelector('.contact-hero__arrow--prev')?.addEventListener('click',()=>{show(active-1);stop();start()});slider.querySelector('.contact-hero__arrow--next')?.addEventListener('click',()=>{show(active+1);stop();start()});dots.forEach((dot,index)=>dot.addEventListener('click',()=>{show(index);stop();start()}));slider.addEventListener('keydown',(event)=>{if(event.key==='ArrowLeft'||event.key==='ArrowRight'){event.preventDefault();show(active+(event.key==='ArrowRight'?1:-1));stop();start()}});slider.addEventListener('touchstart',(event)=>{touchStart=event.touches[0]?.clientX??null},{passive:true});slider.addEventListener('touchend',(event)=>{if(touchStart===null)return;const distance=(event.changedTouches[0]?.clientX??touchStart)-touchStart;touchStart=null;if(Math.abs(distance)>45){show(active+(distance<0?1:-1));stop();start()}},{passive:true});slider.addEventListener('mouseenter',stop);slider.addEventListener('mouseleave',start);slider.addEventListener('focusin',stop);slider.addEventListener('focusout',(event)=>{if(!slider.contains(event.relatedTarget))start()});document.addEventListener('visibilitychange',()=>document.hidden?stop():start());reduceMotion.addEventListener?.('change',()=>reduceMotion.matches?stop():start());start()}

    document.querySelectorAll('.contact-faq__item button').forEach((button)=>button.addEventListener('click',()=>{const item=button.closest('.contact-faq__item');const answer=document.getElementById(button.getAttribute('aria-controls'));const open=button.getAttribute('aria-expanded')==='true';button.setAttribute('aria-expanded',String(!open));item.classList.toggle('is-open',!open);answer.hidden=open}));
});

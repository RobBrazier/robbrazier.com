---
title: Contact Me
---

<style>
#fs-frm input, #fs-frm textarea, #fs-frm fieldset, #fs-frm label {
    font-family: inherit;
    font-size: 100%;
    color: inherit;
    border: none;
    border-radius: 0;
    display: block;
    width: 100%;
    padding: 0;
    margin: 0;
    -webkit-appearance: none;
    -moz-appearance: none;
}
#fs-frm label, #fs-frm ::placeholder {
    font-size: .825rem;
    margin-bottom: .5rem;
    padding-top: .2rem;
    display: flex;
    align-items: baseline;
}

/* border, padding, margin, width */
#fs-frm input, #fs-frm textarea {
    border: 1px solid rgba(0,0,0,0.2);
    background-color: rgba(255,255,255,0.9);
    padding: .75em 1rem;
    margin-bottom: 1.5rem;
}
#fs-frm input:focus {
    background-color: white;
    outline: gray solid thin;
    outline-offset: -1px;
}
#fs-frm [type="text"], #fs-frm [type="email"] { width: 100%; }
#fs-frm [type="submit"] {
    width: auto;
    cursor: pointer;
    margin-bottom: 0;
    color: #222222;
}
#fs-frm [type="submit"]:focus { outline: none; }
</style>

<form id="fs-frm" accept-charset="utf-8" action="https://formspree.io/f/xpzkzdpz" method="post">
  <fieldset id="fs-frm-inputs">
    <label for="full-name">Full Name</label>
    <input type="text" name="name" id="full-name" placeholder="First and Last" required>
    <label for="email-address">Email Address</label>
    <input type="email" name="_replyto" id="email-address" placeholder="email@domain.tld" required>
    <label for="message">Message</label>
    <textarea rows="5" name="message" id="message" required></textarea>
    <input type="hidden" name="_subject" id="email-subject" value="Contact Form Submission">
  </fieldset>
  <input type="submit" value="Submit">
</form>
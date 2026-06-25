<div class="modal-backdrop" id="modalBackdrop" onclick="closeModal()"></div>
<div class="modal" id="enquiryModal">
    <button class="modal-close" onclick="closeModal()">✕</button>
    <div class="modal-header">
        <div class="modal-icon">📩</div>
        <h2>Enquiry Now</h2>
        <p id="modalProductName" class="modal-product-tag"></p>
    </div>
    <form id="enquiryForm" action="{{ route('enquiry.store') }}" method="POST">

        <div class="modal-body">
            @csrf
            <div class="modal-field">
                <label>Your Name *</label>
                <input type="text" name="name" id="enqName" required>
            </div>

            <div class="modal-field">
                <label>Phone Number *</label>
                <input type="tel" name="phone" id="enqPhone" required>
            </div>

            <div class="modal-field">
                <label>Email Address</label>
                <input type="email" name="email" id="enqEmail">
            </div>

            <div class="modal-field">
                <label>City</label>
                <input type="text" name="city" id="enqCity">
            </div>

            <div class="modal-field full">
                <label>Message</label>
                <textarea name="message" id="enqMessage"></textarea>
            </div>


        </div>
    </form>

    <button class="modal-submit" onclick="submitEnquiry()">Send Enquiry →</button>
    <div class="modal-success" id="modalSuccess">
        <div class="success-icon">✅</div>
        <h3>Enquiry Sent!</h3>
        <p>Our team will contact you within 24 hours.</p>
    </div>
</div>
<script src="{{ asset('assets/js/index.js') }}"></script>
@if (isset($js))
    @foreach ($js as $value)
        <script type="module" src="{{ asset('assets/front') }}/js/{{ $value }}.js"></script>
    @endforeach
@endif

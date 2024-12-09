<!-- Delivery to Section -->
<section class="wrapper flex flex-col gap-4 pb-40">
  <div class="flex items-center justify-between">
    <p class="text-base font-bold text-gray-800">Delivery to</p>
    <button type="button" class="p-2 bg-gray-200 rounded-full shadow-md hover:bg-gray-300" data-expand="deliveryForm">
      <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-transform duration-300 rotate-0 size-5" alt="Expand/Collapse">
    </button>
  </div>
  <form enctype="multipart/form-data" action="{{ route('product_transactions.store') }}" method="POST" class="p-6 bg-white rounded-3xl shadow-md hidden" id="deliveryForm">
    @csrf  
    <div class="flex flex-col gap-6">
      <!-- Address -->
      <div class="flex flex-col gap-2">
        <label for="address" class="text-sm font-medium text-gray-700">Address</label>
        <input type="text" name="address" id="address__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none"
          placeholder="Enter your address" value="Jagoi Babang">
      </div>
      <!-- City -->
      <div class="flex flex-col gap-2">
        <label for="city" class="text-sm font-medium text-gray-700">City</label>
        <input type="text" name="city" id="city__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none"
          placeholder="Enter your city" value="Bengkayang">
      </div>
      <!-- Post Code -->
      <div class="flex flex-col gap-2">
        <label for="postcode" class="text-sm font-medium text-gray-700">Post Code</label>
        <input type="number" name="post_code" id="postcode__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none"
          placeholder="Enter your post code" value="475734539">
      </div>
      <!-- Phone Number -->
      <div class="flex flex-col gap-2">
        <label for="phonenumber" class="text-sm font-medium text-gray-700">Phone Number</label>
        <input type="number" name="phone_number" id="phonenumber__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none"
          placeholder="Enter your phone number" value="08214364643">
      </div>
      <!-- Additional Notes -->
      <div class="flex flex-col gap-2">
        <label for="notes" class="text-sm font-medium text-gray-700">Additional Notes</label>
        <textarea name="notes" id="notes__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none"
          placeholder="Enter additional notes here">Masukan NOTE disini, berisi alamat lengkap.</textarea>
      </div>
      <!-- Proof of Payment -->
      <div class="flex flex-col gap-2">
        <label for="proof_of_payment" class="text-sm font-medium text-gray-700">Proof of Payment</label>
        <input type="file" name="proof" id="proof_of_payment__" 
          class="form-input bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:ring-2 focus:ring-primary focus:outline-none">
      </div>
    </div>
    <button type="submit" class="mt-4 px-6 py-2 text-white bg-primary rounded-lg shadow-lg hover:bg-primary-dark focus:ring-2 focus:ring-primary">
      Submit
    </button>
  </form>
</section>

<script>
  // Toggle form visibility
  const toggleButton = document.querySelector('[data-expand="deliveryForm"]');
  const deliveryForm = document.getElementById('deliveryForm');
  const chevronIcon = toggleButton.querySelector('img');

  toggleButton.addEventListener('click', () => {
    const isVisible = !deliveryForm.classList.contains('hidden');
    deliveryForm.classList.toggle('hidden', isVisible);
    chevronIcon.classList.toggle('-rotate-180', !isVisible);
  });
</script>

<style>
  .form-input {
    background-position: left 1rem center;
    background-repeat: no-repeat;
    padding-left: 2.5rem;
  }

  .size-5 {
    width: 1.25rem;
    height: 1.25rem;
  }

  .bg-primary {
    background-color: #4f46e5; /* Customize your primary color */
  }

  .bg-primary-dark {
    background-color: #4338ca; /* Slightly darker shade for hover */
  }

  .focus\:ring-primary {
    --tw-ring-color: #4f46e5;
  }
</style>

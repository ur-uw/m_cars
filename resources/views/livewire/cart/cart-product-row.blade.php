 <tr>
     <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
         <img class="bg-cover h-16 w-16" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }} Image">
     </td>
     <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
         {{ $product->name }}
     </td>
     <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
         ${{ number_format($product->price, 2) }}
     </td>
     <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
         {{ $quantity }}
     </td>
     <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
         <div class="flex flex-col gap-3 lg:gap-0 lg:flex-row lg:justify-evenly lg:items-center">
             <div class="flex flex-col gap-3">
                 <button wire:click='increaseItemQty({{ $product->id }})' type="submit"
                     class="btn btn-primary transition font-bold">
                     +
                 </button>
                 @if ($quantity > 1)
                     <button wire:click='decreaseProductQty({{ $product->id }})' type="submit"
                         class="btn btn-secondary transition font-bold">
                         -
                     </button>
                 @endif
             </div>
             <button wire:click='removeFromCart' type="submit"
                 class="btn bg-black hover:bg-gray-700 text-white transition font-bold">
                 Remove
             </button>
         </div>

     </td>
 </tr>

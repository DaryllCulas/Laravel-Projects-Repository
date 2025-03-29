import { useState } from 'react';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogFooter } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";


const AddPaymentModal = ({isOpen, onClose} : { isOpen: boolean, onClose: ()=> void }) => {
    const [email, setEmail] = useState("");
    const [amount, setAmount] = useState("");
    const [status, setStatus] = useState("");
    const [message, setMessage] = useState<{ type: "success" | "error"; text: string } | null>(null);
    const [loading, setLoading] = useState(false);


    const handleSubmit = async(event: React.FormEvent) => {
        event.preventDefault();
        setLoading(true);
        setMessage(null);

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if(!csrfToken) {
            setMessage({ type: "error", text: "CSRF token missing! Refresh the page"});
            setLoading(false);
            return;
        }

        try {
            const response = await fetch("/payments", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept" : "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                credentials: "same-origin",
                body: JSON.stringify({ email, amount, status }),
            });

            if(response.ok) {
                setMessage({ type: "success", text: "Payment added successfully!"});
                setEmail("");
                setAmount("");
                setStatus("");

                setTimeout(() => {
                    onClose();
                    window.location.reload();
                }, 1500);
            } else {
                const errorData = await response.json();
                setMessage({ type: "error", text: errorData.message || "An error occurred while adding the payment."});
            }
        } catch(error) {
            console.error("Error adding payment:", error);
            setMessage({ type: "error", text: "An error occurred. Please try again"});
        } finally {
            setLoading(false);
        }
    }
    return (
        <Dialog open={isOpen} onOpenChange={onClose}>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Add Payment</DialogTitle>
                </DialogHeader>
                <form onSubmit={handleSubmit} className='space-y-2'>
                    {message && (
                        <div className={`p-2 rounded ${message.type === "success" ? "bg-green-200 text-green-800" : "bg-red-200 text-red-800"}`}>
                            {message.text}
                        </div>)}
                        <Input type='email' placeholder='Enter Email' value={email} onChange={(e) => setEmail(e.target.value)} required/>
                        <Input type='number' placeholder='Enter Amount' value={amount} onChange={(e) => setAmount(e.target.value)} required/>
                        <select value={status} onChange={(e) => setStatus(e.target.value)} className="border p-2 rounded w-full" required>
                            <option value="">Select Status</option>
                            <option value="processing">Processing</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                        <DialogFooter>
                            <Button variant="outline" type='button' onClick={onClose} disabled={loading}>Cancel</Button>
                            <Button type='submit' disabled={loading}>{loading ? "Processing..." : "Add Payment"}</Button>
                        </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    );
}

export default AddPaymentModal;

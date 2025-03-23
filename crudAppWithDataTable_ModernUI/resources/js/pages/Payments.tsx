import { EditPaymentModal } from '@/components/EditPaymentModal';
import { Payment, columns } from '@/components/payments/columns';
import { DataTable } from '@/components/payments/data-table';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useEffect, useState } from 'react';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Payments',
        href: '/payments',
    },
];

export default function DemoPage({ payments }: { payments: Payment[] }) {
    const [data, setData] = useState<Payment[]>([payments]);
    const [editModalOpen, setEditModalOpen] = useState(false);
    const [ selectedPayment, setSelectedPayment] = useState<Payment | null>(null);

    useEffect(() => {
        setData(payments);
    }, [payments]);


    const handleUpdate = (updatedPayment: Payment) => {
        setData((prevData) =>
            prevData.map((payment) => {
                if(payment.id === updatedPayment.id) {
                    return updatedPayment;
                }

                return payment;
            })
        )
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="container mx-auto py-10">
                <DataTable columns={columns(() => {}, setEditModalOpen, setSelectedPayment)} data={payments} />
            </div>

            <EditPaymentModal isOpen={editModalOpen} onClose={() => setEditModalOpen(false) } payment={selectedPayment} onUpdate={handleUpdate}/>
        </AppLayout>
    );
}

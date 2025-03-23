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
    useEffect(() => {
        setData(payments);
    }, [payments]);

    const [data, setData] = useState<Payment[]>([payments]);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="container mx-auto py-10">
                <DataTable columns={columns} data={payments} />
            </div>
        </AppLayout>
    );
}

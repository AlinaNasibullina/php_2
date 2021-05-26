<?php

namespace MyApp\Models;

class Admin extends Model
{
    const TABEL = 'orders';
    const TABEL_DETAILS = 'order_list';
    const NEW_ORDER = 1;
    const WAIT_PAY = 2;
    const PAID = 3;
    const SEND = 4;
    const DELIVERED = 5;
    const CLOSED = 6;
    const CANCELED = 7;

    public static function getOrders()
    {
        $orders = self::link()->query('SELECT 
                o.id, o.order_state, o.user_id, o.create_date, o.pay_date, u.user_name, u.user_full_name
            FROM orders o 
                LEFT JOIN users u ON u.id = o.user_id 
                ORDER BY o.id DESC')->fetchAll(\PDO::FETCH_ASSOC);
        return $orders;
    }

    public static function getOrderDetails($order_id)
    {
        return self::link()->query('SELECT o.id, o.create_date, o.pay_date, o.order_state, u.user_name, l.product_id, l.product_count, l.product_price, l.subtotal_sum, l.total_sum, l.user_address, p.product_code, p.product_name, p.img 
            FROM users u 
            LEFT JOIN orders o ON u.id = o.user_id 
            LEFT JOIN ' . self::TABEL_DETAILS . ' l ON l.order_id = o.id
            LEFT JOIN product p ON p.id = l.product_id 
            WHERE l.order_id = ' . $order_id)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function cancelOrder($order_id)
    {
        return self::link()
        ->query('UPDATE ' . self::TABEL . ' SET order_state = ' . self::CANCELED . ' WHERE id = ' . $order_id);
    }

    public static function acceptOrder($order_id)
    {
        return self::link()
        ->query('UPDATE ' . self::TABEL . ' SET order_state = ' . self::WAIT_PAY . ' WHERE id = ' . $order_id);
    }
    
    public static function sendOrder($order_id)
    {
        return self::link()
        ->query('UPDATE ' . self::TABEL . ' SET order_state = ' . self::SEND . ' WHERE id = ' . $order_id);
    }
}
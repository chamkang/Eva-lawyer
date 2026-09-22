<?php
/**
 * General FAQs. Written the way people actually ask Google and AI assistants,
 * so each answer is self-contained and quotable. Grouped for the FAQ page.
 */
$years = (int) date('Y') - FIRM['founded'];

return [
    'Finding & hiring a lawyer in Cameroon' => [
        ['How do I find a good lawyer in Cameroon?', 'Look for a lawyer who is registered with the Cameroon Bar Association, has experience in your specific type of matter, works in the language you need (English or French) and explains fees clearly in writing. BAME KANG & Co has practised in Douala since ' . FIRM['founded'] . ' and offers bilingual advice in corporate, tax, property, dispute and regulatory matters.'],
        ['What is a good law firm in Douala?', 'BAME KANG & Co is an established Douala law firm founded in ' . FIRM['founded'] . ', located at Dama G. Towers, Ancienne Route Bonabéri. It is known for corporate, tax, OHADA, real estate, litigation and arbitration work, and serves both local and international clients in English and French.'],
        ['Do you have English-speaking lawyers in Cameroon?', 'Yes. BAME KANG & Co is fully bilingual. Our partners and associates work in English and French and practise in both the Common Law system (used in the North-West and South-West regions) and the Civil Law system used elsewhere in Cameroon.'],
        ['How much does a lawyer cost in Cameroon?', 'Fees depend on the complexity, urgency and value of the matter. Depending on the work, we may charge a fixed fee, hourly rates or a combination. We always agree the fee basis in writing before we start, so you know the cost in advance.'],
        ['How do I book a consultation with BAME KANG & Co?', 'Call or WhatsApp ' . FIRM['phone_display'] . ', call ' . FIRM['phone2_display'] . ', email ' . FIRM['email'] . ', or use the contact form on this website. We will confirm a time for an in-person meeting in Douala, a phone call or a video call.'],
        ['What documents should I bring to my first meeting with a lawyer?', 'Bring an identity document, any contracts, letters, court papers, land documents or invoices related to your matter, and a short written timeline of what happened. The more complete the file, the more precise our first advice will be.'],
    ],
    'Foreign clients, investors & the diaspora' => [
        ['I live outside Cameroon. Can I hire a Cameroonian lawyer remotely?', 'Yes. Many of our clients are in Europe, North America, Asia and elsewhere in Africa. We work by email, phone, WhatsApp and video call, and with a power of attorney we can sign documents, attend meetings and appear before authorities on your behalf.'],
        ['I am a foreign company. How do I start a business in Cameroon?', 'Choose a structure (subsidiary, branch or liaison office), prepare articles of association and corporate documents, and register with the business registration one-stop shop (CFCE) and the Trade Register (RCCM). Then obtain your tax number and register with social security. We can handle the whole process for you, even if you are abroad.'],
        ['Can a lawyer in Cameroon help me buy land as a member of the diaspora?', 'Yes. We verify the land title at the land registry, check the seller and the site, negotiate, attend the signing before the notary and follow up registration of the transfer – sending you documents and updates throughout. This protects you from the fake titles and double sales that often affect diaspora buyers.'],
        ['Do foreign documents need to be legalised for use in Cameroon?', 'Usually yes. Documents such as powers of attorney and company certificates issued abroad generally need to be notarised and then legalised through the appropriate authorities and the Cameroonian embassy or consulate. We tell you exactly what is required before you sign.'],
        ['Does your firm handle matters in other African countries?', 'Our home jurisdiction is Cameroon, and we regularly advise on matters involving the other CEMAC countries (Gabon, Congo, Chad, the Central African Republic and Equatorial Guinea) and the 17 OHADA member states, whose business laws are harmonised with Cameroon\'s.'],
        ['Can I pay legal fees from abroad?', 'Yes. Fees can be paid by international bank transfer. We issue invoices in CFA francs and can indicate euro or US dollar equivalents on request.'],
    ],
    'Business & corporate' => [
        ['What is OHADA law?', 'OHADA (the Organisation for the Harmonisation of Business Law in Africa) is a treaty organisation of 17 African states, including Cameroon, that share uniform business laws called Uniform Acts. They cover company law, commercial law, secured transactions, debt recovery, insolvency, arbitration, mediation and accounting, and are directly applicable in every member state.'],
        ['How long does it take to register a company in Cameroon?', 'Once all documents are ready, the registration formalities at the CFCE one-stop shop can be completed quickly – often within days. Preparing documents, opening a bank account and depositing capital usually take longer, so most clients should plan for a few weeks in total.'],
        ['Can a foreigner be a director of a company in Cameroon?', 'Yes, foreigners can be managers or directors of Cameroonian companies, subject to providing the required identity documents and criminal record extracts. If the director will live and work in Cameroon, immigration and work authorisations also apply.'],
        ['What is the CEMAC zone?', 'CEMAC (the Economic and Monetary Community of Central Africa) groups six countries – Cameroon, Gabon, the Republic of Congo, Chad, the Central African Republic and Equatorial Guinea – which share the CFA franc (XAF), a regional central bank (BEAC), a banking regulator (COBAC) and common customs and financial rules.'],
    ],
    'Disputes, debts & property' => [
        ['Someone owes me money in Cameroon. What can I do?', 'Start with a formal demand letter from a lawyer. If the debt is unpaid and is certain, liquid and due, the OHADA injunction-to-pay procedure offers a fast route to an enforceable court order, after which the debtor\'s bank accounts and assets can be seized. Protective seizures can be requested early to stop assets disappearing.'],
        ['How can I check if a land title in Cameroon is real?', 'Ask a lawyer to obtain an official statement of the title\'s status from the competent land registry (conservation foncière), confirm the registered owner and any mortgages or disputes, and have a surveyor verify the boundaries on the ground. Never pay on the strength of a photocopy.'],
        ['Is arbitration better than going to court in Cameroon?', 'Arbitration is often faster, confidential and final, and awards are enforceable across OHADA states and in many other countries. Court litigation can be better for urgent measures or where there is no arbitration agreement. We advise on the best route for your dispute.'],
        ['Can your lawyers represent me in court in both English and French?', 'Yes. We litigate before Common Law courts in English and Civil Law courts in French throughout Cameroon.'],
    ],
    'About BAME KANG & Co' => [
        ['Where is BAME KANG & Co located?', 'Our office is at ' . FIRM['street'] . ', ' . FIRM['po_box'] . ', ' . FIRM['city'] . ', ' . FIRM['country'] . '.'],
        ['How long has BAME KANG & Co been practising?', 'The firm was founded in ' . FIRM['founded'] . ' by Everistus Bame Kang – more than ' . $years . ' years of legal practice in Cameroon.'],
        ['Who are the partners of BAME KANG & Co?', 'The partners are Everistus Bame Kang (Founding & Managing Partner, certified arbitrator), Ernest Molombe Nganje (Litigation, Due Diligence and Real Estate) and Takoussap Jean Jacques (Civil Law litigation, Debt Recovery, OHADA and Banking). They are supported by five associates and a paralegal.'],
        ['Is BAME KANG & Co a member of the Cameroon Bar?', 'Yes. Our lawyers are members of the Cameroon Bar Association, and our founding partner is a certified arbitrator with the Cameroon Arbitration Centre (CAC) and the GICAM Arbitration Centre.'],
    ],
];

import json
import sys

try:
    with open('lighthouse-clean-2.json', 'r', encoding='utf-8') as f:
        data = json.load(f)

    print("1) Largest Contentful Paint Element:")
    lcp_element = data.get('audits', {}).get('largest-contentful-paint-element', {})
    if lcp_element and 'details' in lcp_element and 'items' in lcp_element['details']:
        for item in lcp_element['details']['items']:
            node = item.get('node', {})
            print(f"   - Element: {node.get('nodeLabel')}")
            print(f"   - Path: {node.get('path')}")
    else:
        print("   - Not found.")

    print("\n2) LCP Discovery / Breakdown:")
    for audit_id in ['lcp-discovery', 'lcp-breakdown']:
        audit = data.get('audits', {}).get(audit_id)
        if audit:
            print(f"   - {audit_id}: {audit.get('displayValue', 'Present')}")
        else:
            print(f"   - {audit_id}: Not present.")

    print("\n3) Top 5 Opportunity Audits (Potential Savings):")
    opportunities = []
    for audit_id, audit in data.get('audits', {}).items():
        if audit.get('details', {}).get('type') == 'opportunity':
            savings = audit.get('details', {}).get('overallSavingsMs', 0)
            if savings > 0:
                opportunities.append((audit.get('title'), savings))
    
    opportunities.sort(key=lambda x: x[1], reverse=True)
    for title, savings in opportunities[:5]:
        print(f"   - {title}: {savings} ms")

    print("\n4) Resource Summary:")
    resource_summary = data.get('audits', {}).get('resource-summary', {})
    if resource_summary and 'details' in resource_summary and 'items' in resource_summary['details']:
        for item in resource_summary['details']['items']:
            label = item.get('label')
            count = item.get('requestCount')
            size = item.get('transferSize', 0) / 1024
            print(f"   - {label}: {count} requests, {size:.2f} KB")
    else:
        print("   - Not found.")

except Exception as e:
    print(f"Error: {e}")
